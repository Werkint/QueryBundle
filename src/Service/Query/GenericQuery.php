<?php
namespace Werkint\Bundle\QueryBundle\Service\Query;

use Werkint\Bundle\QueryBundle\Service\Result\GenericResult;

/**
 * Типичный запрос
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class GenericQuery implements
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

    /**
     * @inheritdoc
     */
    public function createResponse(array $objects)
    {
        return new GenericResult($objects);
    }
}