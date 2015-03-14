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
     * @var Author
     */
    protected $author;
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
     * @param Author $author
     * @param ThreadSubject $threadSubject
     * @param ThreadBody $threadBody
     * @return static
     */
    public static function openThread(
        ThreadId $threadId,
        Author $author,
        ThreadSubject $threadSubject,
        ThreadBody $threadBody
    ) {
        $thread = new static();

        $thread->apply(new ThreadDiscussesBegun($threadId, $author, $threadSubject, $threadBody));

        return $thread;
    }


    /**
     * @param ThreadDiscussesBegun $threadDiscussesBegun
     */
    public function applyThreadDiscussesBegun(ThreadDiscussesBegun $threadDiscussesBegun)
    {
        $this->threadId = $threadDiscussesBegun->getThreadId();
        $this->author = $threadDiscussesBegun->getAuthor();
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


}