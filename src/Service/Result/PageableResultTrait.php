<?php
namespace Werkint\Bundle\QueryBundle\Service\Query;

/**
 * Ответ для пагинации
 *
 * @see    PageableQueryTrait
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
trait PageableResultTrait
{
    /**
     * Текущая страница. Может быть указана, только если
     * стоит @see pageGroup
     *
     * @var int|null
     */
    private $page;
    /**
     * Разбиение по страницам. Количество элементов на страницу
     *
     * @var int|null
     */
    private $pageGroup;
    /**
     * Общее количество страниц
     *
     * @var int|null
     */
    private $pageCount;
    /**
     * Общее количество объектов
     *
     * @var int|null
     */
    private $totalCount;

    /**
     * @param int|null $page
     * @param int|null $pageGroup
     * @param int|null $pageCount
     * @param int|null $totalCount
     */
    public function setPageResult(
        $page,
        $pageGroup,
        $pageCount,
        $totalCount
    ) {
        $this->page = $page;
        $this->pageGroup = $pageGroup;
        $this->pageCount = $pageCount;
        $this->totalCount = $totalCount;
    }

    // -- Accessors ---------------------------------------

    /**
     * @return int|null
     */
    public function getPageGroup()
    {
        return $this->pageGroup;
    }

    /**
     * @return int|null
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return int|null
     */
    public function getTotalCount()
    {
        return $this->totalCount;
    }

    /**
     * @return int|null
     */
    public function getPageCount()
    {
        return $this->pageCount;
    }
}