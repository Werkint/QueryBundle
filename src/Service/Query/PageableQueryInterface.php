<?php
namespace Werkint\Bundle\QueryBundle\Service\Query;

/**
 * @see    PageableQueryTrait
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
interface PageableQueryInterface
{
    /**
     * @return int|null
     */
    public function getPage();

    /**
     * @return int|null
     */
    public function getPageGroup();
}