<?php
namespace Werkint\Bundle\QueryBundle\Service\Handler;

use Werkint\Bundle\QueryBundle\Service\Query\QueryInterface;
use Werkint\Bundle\QueryBundle\Service\Result\ResultInterface;

/**
 * Обработчик запроса по объектам
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
interface HandlerInterface
{
    /**
     * @param QueryInterface $query
     * @return ResultInterface
     */
    public function query(QueryInterface $query);
}