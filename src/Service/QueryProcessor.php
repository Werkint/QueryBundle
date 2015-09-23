<?php
namespace Werkint\Bundle\QueryBundle\Service;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @see    QueryProcessorInterface
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class QueryProcessor implements
    QueryProcessorInterface
{
    private $eventDispatcher;

    public function __construct(
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @inheritdoc
     */
    public function process(Query\QueryInterface $query)
    {
        $handler = $this->getQueryHandler($query);
        if (!$handler) {
            throw new \Exception('Not supported');
        }

        $result = $handler->query($query);

        $event = new Event\QueryResultEvent($result);
        $this->eventDispatcher->dispatch($event::NAME, $event);

        return $result;
    }

    /**
     * @param Query\QueryInterface $query
     * @return null|Handler\HandlerInterface
     */
    private function getQueryHandler(Query\QueryInterface $query)
    {
        foreach ($this->handlers as $handler) {
            if ($handler->isQuerySupported($query)) {
                return $handler;
            }
        }

        return null;
    }

    /**
     * @var array|Handler\HandlerInterface[]
     */
    private $handlers = [];

    /**
     * @param Handler\HandlerInterface $handler
     */
    public function addHandler(Handler\HandlerInterface $handler)
    {
        $this->handlers[] = $handler;
    }
}