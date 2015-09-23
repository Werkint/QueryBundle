<?php
namespace Werkint\Bundle\QueryBundle\Service\Result;

use Werkint\Bundle\QueryBundle\Service\Query\PageableResultInterface;
use Werkint\Bundle\QueryBundle\Service\Query\PageableResultTrait;

/**
 * Типичный ответ
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
abstract class AbstractGenericResult implements
    ResultInterface,
    PageableResultInterface
{
    use PageableResultTrait;

    /**
     * @var object[]|array
     */
    private $objects;

    public function __construct(
        array $objects
    ) {
        $this->objects = $objects;
    }

    // -- Accessors ---------------------------------------

    /**
     * @return array|\object[]
     */
    public function getObjects()
    {
        return $this->objects;
    }
}