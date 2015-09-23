<?php
namespace Werkint\Bundle\QueryBundle\Service\EventListener;

use Knp\Component\Pager\PaginatorInterface;
use Werkint\Bundle\QueryBundle\Service\Handler\QueryResultEvent;
use Werkint\Bundle\QueryBundle\Service\Query\PageableResultInterface;
use Werkint\Bundle\QueryBundle\Service\Result\PaginatorAwareTrait;

/**
 * Добавляет объект пагинатора
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class PageableResultListener
{
    private $paginator;

    public function __construct(
        PaginatorInterface $paginator
    ) {
        $this->paginator = $paginator;
    }

    public function onResult(QueryResultEvent $event)
    {
        $result = $event->getResult();

        if ($result instanceof PageableResultInterface && method_exists($result, 'setPaginator')) {
            /** @var PaginatorAwareTrait $result */
            $paginator = $this->paginator->paginate(
                range(1, max($result->getPageCount(), 1)),
                $result->getPage(),
                1
            );

            $result->setPaginator($paginator);
        }
    }
}