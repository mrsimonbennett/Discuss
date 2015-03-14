<?php
namespace Discuss\Discussion\Events;

use Broadway\Serializer\SerializableInterface;
use Discuss\Discussion\Author;
use Discuss\Discussion\AuthorId;
use Discuss\Discussion\ThreadBody;
use Discuss\Discussion\ThreadId;
use Discuss\Discussion\ThreadSubject;

/**
 * Class ThreadDiscussesBegun
 * @package Discuss\Discussion\Events
 * @author Simon Bennett <simon@bennett.im>
 */
final class ThreadDiscussesBegun implements SerializableInterface
{
    /**
     * @var ThreadId
     */
    private $threadId;
    /**
     * @var Author
     */
    private $author;

    /**
     * @var ThreadSubject
     */
    private $threadSubject;
    /**
     * @var ThreadBody
     */
    private $threadBody;

    /**
     * @param ThreadId $threadId
     * @param Author $author
     * @param ThreadSubject $threadSubject
     * @param ThreadBody $threadBody
     */
    public function __construct(
        ThreadId $threadId,
        Author $author,
        ThreadSubject $threadSubject,
        ThreadBody $threadBody
    ) {
        $this->threadId = $threadId;
        $this->author = $author;
        $this->threadSubject = $threadSubject;
        $this->threadBody = $threadBody;
    }

    /**
     * @return ThreadId
     */
    public function getThreadId()
    {
        return $this->threadId;
    }

    /**
     * @return Author
     */
    public function getAuthor()
    {
        return $this->author;
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

    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        return new static(
            new ThreadId($data['id']),
            new Author(new AuthorId($data['authorId'])),
            ThreadSubject::deserialize($data['threadSubject']),
            ThreadBody::deserialize($data['threadBody'])
        );
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return [
            'id' => (string)$this->threadId,
            'authorId' => (string)$this->author->getAuthorId(),
            'threadSubject' => $this->threadSubject->serialize(),
            'threadBody' => $this->threadBody->serialize(),
        ];
    }
}