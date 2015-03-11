<?php
namespace Discuss\Aggregate;

use InvalidArgumentException;
use ReflectionClass;

/**
 * Class AggregateRoot
 * @package Discuss\Aggregate
 * @author  Simon Bennett <simon@bennett.im>
 */
trait AggregateRoot
{
    /**
     * @var array $events
     */
    private $events = array();

    /**
     * Applies event and adds it to history
     * @param $event
     */
    private function apply($event)
    {
        $eventName = (new ReflectionClass($event))->getShortName();
        $methodName = "apply{$eventName}";
        if (!is_callable([$this, $methodName]) || $methodName === __METHOD__) {
            throw new InvalidArgumentException(
                "There is no handler registered for {$eventName}"
            );
        }
        $this->{$methodName}($event);
        $this->events[] = $event;
    }

    /**
     * Flushes the array queue and returns the events
     *
     * @return array
     */
    public function releaseEvents()
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    public function getEvents()
    {
        return $this->events;
    }


}