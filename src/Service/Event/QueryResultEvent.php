<?php
namespace Werkint\Bundle\QueryBundle\Service\Event;

use Symfony\Component\EventDispatcher\Event;
use Werkint\Bundle\QueryBundle\Service\Result\ResultInterface;

/**
 * Событие выборки из базы
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class QueryResultEvent extends Event
{
    const NAME = 'werkint_query.queryresult';

    /**
     * @var ResultInterface
     */
    private $result;

    public function __construct(
        ResultInterface $result
    ) {
        $this->result = $result;
    }

    // -- Accessors ---------------------------------------

    /**
     * @return ResultInterface
     */
    public function getResult()
    {
        return $this->result;
    }
}