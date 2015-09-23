<?php
namespace Werkint\Bundle\QueryBundle\Service\Result;

/**
 * @see    PageableResultTrait
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
interface PageableResultInterface
{
    /**
     * @return int|null
     */
    public function getPage();

    /**
     * @return int|null
     */
    public function getPageGroup();

    /**
     * @return int|null
     */
    public function getPageCount();

    /**
     * @return int|null
     */
    public function getTotalCount();
}