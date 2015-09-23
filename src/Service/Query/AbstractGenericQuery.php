<?php
namespace Werkint\Bundle\QueryBundle\Service\Query;

/**
 * Типичный запрос
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
abstract class AbstractGenericQuery implements
    QueryInterface,
    OrderableQueryInterface,
    PageableQueryInterface
{
    use OrderableQueryTrait;
    use PageableQueryTrait;

    public function __construct()
    {
        $this->clear();
    }

    public function clear()
    {
        $this->clearOrder();
        $this->clearPage();
    }
}