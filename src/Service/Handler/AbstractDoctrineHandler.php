<?php
namespace Werkint\Bundle\QueryBundle\Service\Handler;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Werkint\Bundle\QueryBundle\Service\Query\OrderableQueryInterface;
use Werkint\Bundle\QueryBundle\Service\Query\PageableQueryInterface;
use Werkint\Bundle\QueryBundle\Service\Query\QueryInterface;
use Werkint\Bundle\QueryBundle\Service\Result\PageableResultInterface;
use Werkint\Bundle\QueryBundle\Service\Result\PageableResultTrait;

/**
 * Делает выборку при помощи Doctrine-репозитария
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
abstract class AbstractDoctrineHandler implements
    HandlerInterface
{
    const TABLE_ALIAS = 't';

    /**
     * @inheritdoc
     */
    public function query(QueryInterface $query)
    {
        // Создаем QB
        $qbr = $this->createQueryBuilder($query);

        // Применяем фильтры
        $this->applyFilters($qbr, $query);

        // Если нужно - разбиваем по страницам
        if ($query instanceof PageableQueryInterface && $query->getPage()) {
            $totalCount = $this->getTotalCount(clone $qbr);
            $limitFrom = ($query->getPage() - 1) * $query->getPageGroup();
            $qbr->setFirstResult($limitFrom)
                ->setMaxResults($query->getPageGroup());
        }

        $ids = $this->getIds(clone $qbr);

        // Создаем QB
        $qbr = $this->createQueryBuilder($query);
        $qbr->where($this->buildIdsCondition($ids, $qbr));

        // Сортировка
        if ($query instanceof OrderableQueryInterface && $query->getOrderField()) {
            $qbr->orderBy(
                $query->getOrderField(),
                $query->getOrderDirection()
            );
        }

        $queryResult = $qbr
            ->getQuery()
            ->getResult();

        $result = $query->createResponse($queryResult);

        if (isset($totalCount)) {
            if ($result instanceof PageableResultInterface && method_exists($result, 'setPageResult')) {
                /** @var PageableResultTrait $result */

                $pageCount = $query->getPageGroup() ? ceil($totalCount / $query->getPageGroup()) : 1;
                $result->setPageResult(
                    $query->getPage(),
                    $query->getPageGroup(),
                    $pageCount,
                    $totalCount
                );
            } else {
                throw new \Exception('Result not pageable');
            }
        }

        return $result;
    }

    /**
     * @param array        $ids
     * @param QueryBuilder $qbr
     * @return Query\Expr\Comparison|Query\Expr\Orx
     */
    private function buildIdsCondition(array $ids, QueryBuilder $qbr)
    {
        $cond = $qbr->expr()->eq(1, 0);
        foreach ($ids as $row) {
            $cond = $qbr->expr()->orX($cond, sprintf(
                '%s.id=\'%s\'',
                static::TABLE_ALIAS,
                (string)$row
            ));
        }

        return $cond;
    }

    /**
     * @param QueryBuilder $qbr
     * @return array
     */
    private function getIds(QueryBuilder $qbr)
    {
        $qbr->select(sprintf('%s.id', static::TABLE_ALIAS))
            ->groupBy(sprintf('%s.id', static::TABLE_ALIAS));

        $rows = $qbr
            ->getQuery()
            ->getResult();

        return array_map(function (array $row) {
            return $row['id'];
        }, $rows);
    }

    /**
     * @param QueryBuilder $qbr
     * @return int|null
     */
    private function getTotalCount(QueryBuilder $qbr)
    {
        $result = $qbr->select(sprintf('count(distinct %s.id) as ccc', static::TABLE_ALIAS))
            ->getQuery()
            ->getSingleScalarResult();

        return $result === null ? $result : (int)$result;
    }

    /**
     * Применяет фильтры к QueryBuilder
     *
     * @param QueryBuilder   $qbr
     * @param QueryInterface $query
     * @return QueryBuilder
     */
    abstract protected function applyFilters(QueryBuilder $qbr, QueryInterface $query);

    /**
     * Создает строителя запроса
     *
     * @param QueryInterface $query
     * @return QueryBuilder
     */
    abstract protected function createQueryBuilder(QueryInterface $query);
}