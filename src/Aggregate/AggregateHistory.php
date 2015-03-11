<?php
namespace Discuss\Aggregate;

use ArrayIterator;
use Discuss\UuidIdentity;
use IteratorAggregate;
use Traversable;

/**
 * Class AggregateHistory
 * @package Discuss\Aggregate
 * @author  Simon Bennett <simon@bennett.im>
 */
final class AggregateHistory implements IteratorAggregate
{
    /**
     * @var array
     */
    private $events;
    /**
     * @var UuidIdentity
     */
    private $aggregateId;

    /**
     * @param UuidIdentity $aggregateId
     * @param array $events
     */
    public function __construct(UuidIdentity $aggregateId, array $events)
    {
        $this->events = $events;
        $this->aggregateId = $aggregateId;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     */
    public function getIterator()
    {
        return new ArrayIterator($this->events);
    }

    /**
     * @return UuidIdentity
     */
    public function getAggregateId()
    {
        return $this->aggregateId;
    }

}