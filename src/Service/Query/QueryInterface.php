<?php
namespace Werkint\Bundle\QueryBundle\Service\Query;

use Werkint\Bundle\QueryBundle\Service\Result\ResultInterface;

/**
 * Запрос для выборки объектов
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
interface QueryInterface
{
    /**
     * Устанавливает на все поля значения по-умолчанию
     */
    public function clear();

    /**
     * Создаёт объект ответа
     * @param array $objects
     * @return ResultInterface
     */
    public function createResponse(array $objects);
}