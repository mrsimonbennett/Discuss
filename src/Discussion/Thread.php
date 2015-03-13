<?php
namespace Discuss\Discussion;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Discuss\Discussion\Events\ThreadDiscussesBegun;

/**
 * Class Thread
 * @package Discuss\Discussion
 * @author Simon Bennett <simon@bennett.im>
 */
final class Thread extends EventSourcedAggregateRoot
{
    /**
     * @var ThreadId
     */
    protected $threadId;
    /**
     * @var ThreadAuthorId
     */
    protected $authorId;
    /**
     * @var ThreadSubject
     */
    protected $threadSubject;
    /**
     * @var ThreadBody
     */
    protected $threadBody;

    /**
     * @param ThreadId $threadId
     * @param ThreadAuthorId $authorId
     * @param ThreadSubject $threadSubject
     * @param ThreadBody $threadBody
     * @return static
     */
    public static function startThread(
        ThreadId $threadId,
        ThreadAuthorId $authorId,
        ThreadSubject $threadSubject,
        ThreadBody $threadBody
    ) {
        $thread = new static();

        $thread->apply(new ThreadDiscussesBegun($threadId, $authorId, $threadSubject, $threadBody));

        return $thread;
    }


    /**
     * @param ThreadDiscussesBegun $threadDiscussesBegun
     */
    public function applyThreadDiscussesBegun(ThreadDiscussesBegun $threadDiscussesBegun)
    {
        $this->threadId = $threadDiscussesBegun->getThreadId();
        $this->authorId = $threadDiscussesBegun->getAuthorId();
        $this->threadSubject = $threadDiscussesBegun->getThreadSubject();
        $this->threadBody = $threadDiscussesBegun->getThreadBody();
    }

    /**
     * @return string
     */
    public function getAggregateRootId()
    {
        return $this->threadId;
    }

    /**
     * @return ThreadId
     */
    public function getThreadId()
    {
        return $this->threadId;
    }

    /**
     * @return ThreadAuthorId
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @return ThreadSubject
     */
    public function getThreadSubject()
    {
        return $this->threadSubject;
    }

    /**
     * @return ThreadBody
     */
    public function getThreadBody()
    {
        return $this->threadBody;
    }

}