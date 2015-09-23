<?php
namespace Werkint\Bundle\QueryBundle\Service\Result;

/**
 * Результат запроса по объектам
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
interface ResultInterface
{
    /**
     * @return array|\object[]
     */
    public function getObjects();
}