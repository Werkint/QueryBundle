<?php
namespace Werkint\Bundle\QueryBundle\Service\Query;

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
}