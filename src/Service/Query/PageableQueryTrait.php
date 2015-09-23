<?php
namespace Werkint\Bundle\QueryBundle\Service\Query;

/**
 * Запрос, который позволяет пагинировать коллекцию
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
trait PageableQueryTrait
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

    protected function clearPage()
    {
        $this
            ->setPage(null)
            ->setPageGroup(null);
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
     * @param int|null $pageGroup
     * @return $this
     */
    public function setPageGroup($pageGroup)
    {
        $this->pageGroup = $pageGroup;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int|null $page
     * @return $this
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }
}