<?php
namespace Werkint\Bundle\QueryBundle\Service\Query;

/**
 * Запрос, который позволяет сортировать коллекцию
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
trait OrderableQueryTrait
{
    /**
     * @var string|null
     */
    private $orderField;
    /**
     * @var string
     */
    private $orderDirection;

    protected function clearOrder()
    {
        $this
            ->setOrderField(null)
            ->setOrderDirection(OrderableQueryInterface::ORDER_ASC);
    }

    // -- Accessors ---------------------------------------

    /**
     * @return string
     */
    public function getOrderDirection()
    {
        return $this->orderDirection;
    }

    /**
     * @param string $orderDirection
     * @return $this
     */
    public function setOrderDirection($orderDirection)
    {
        $this->orderDirection = $orderDirection;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getOrderField()
    {
        return $this->orderField;
    }

    /**
     * @param null|string $orderField
     * @return $this
     */
    public function setOrderField($orderField)
    {
        $this->orderField = $orderField;
        return $this;
    }
}