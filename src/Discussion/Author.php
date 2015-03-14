<?php
namespace Discuss\Discussion;

/**
 * Class Author
 * @package Discuss\Discussion
 * @author Simon Bennett <simon@bennett.im>
 */
final class Author
{
    /**
     * @var AuthorId
     */
    private $authorId;

    /**
     * @param AuthorId $authorId
     */
    public function __construct(AuthorId $authorId)
    {
        $this->authorId = $authorId;
    }

    /**
     * @param ThreadId $threadId
     * @param ThreadSubject $threadSubject
     * @param ThreadBody $threadBody
     * @return static
     */
    public function openThread(ThreadId $threadId, ThreadSubject $threadSubject, ThreadBody $threadBody)
    {
        return Thread::openThread($threadId, $this, $threadSubject, $threadBody);
    }

    /**
     * @return AuthorId
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

}