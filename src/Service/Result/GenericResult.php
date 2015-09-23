<?php
namespace Werkint\Bundle\QueryBundle\Service\Result;

/**
 * Типичный ответ
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class GenericResult implements
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