<?php
namespace Discuss\Discussion;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Discuss\Discussion\Events\ThreadDiscussesBegun;
use Discuss\Membership\MemberId;

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
     * @var MemberId
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
     * @param MemberId $authorId
     * @param ThreadSubject $threadSubject
     * @param ThreadBody $body
     */
    public static function startThread(
        ThreadId $threadId,
        MemberId $authorId,
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
     * @return MemberId
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