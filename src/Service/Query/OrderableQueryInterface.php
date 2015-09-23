<?php
namespace Werkint\Bundle\QueryBundle\Service\Query;

/**
 * @see    OrderableQueryTrait
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
interface OrderableQueryInterface
{
    const ORDER_ASC = 'asc';
    const ORDER_DESC = 'desc';

    /**
     * @return string
     */
    public function getOrderDirection();

    /**
     * @return null|string
     */
    public function getOrderField();
}