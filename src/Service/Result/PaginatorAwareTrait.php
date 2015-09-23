<?php
namespace Werkint\Bundle\QueryBundle\Service\Result;

/**
 * TODO: write "PaginatorAwareTrait" info
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
trait PaginatorAwareTrait
{
    /**
     * @var PaginatorInterface|null
     */
    private $paginator;

    /**
     * @param PaginatorInterface $paginator
     */
    public function setPaginator(
        PaginatorInterface $paginator
    ) {
        $this->paginator = $paginator;
    }

    /**
     * @return null|PaginatorInterface
     */
    public function getPaginator()
    {
        return $this->paginator;
    }
}