<?php
namespace Werkint\Bundle\QueryBundle\Service;

/**
 * Обрабатывает запросы к объектам
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
interface QueryProcessorInterface
{
    /**
     * @param Query\QueryInterface $query
     * @return Result\ResultInterface
     * @throws \Exception
     */
    public function process(Query\QueryInterface $query);
}