<?php
namespace Discuss\Discussion;

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