<?php
namespace Discuss\Discussion\Events;

use Broadway\Serializer\SerializableInterface;
use Discuss\Discussion\ThreadAuthorId;
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
     * @var ThreadAuthorId
     */
    private $authorId;

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
     * @param ThreadAuthorId $authorId
     * @param ThreadSubject $threadSubject
     * @param ThreadBody $threadBody
     */
    public function __construct(
        ThreadId $threadId,
        ThreadAuthorId $authorId,
        ThreadSubject $threadSubject,
        ThreadBody $threadBody
    ) {
        $this->threadId = $threadId;
        $this->authorId = $authorId;

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

    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        return new static(
            new ThreadId($data['id']),
            new ThreadAuthorId($data['authorId']),
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
            'authorId' => (string)$this->authorId,
            'threadSubject' => $this->threadSubject->serialize(),
            'threadBody' => $this->threadBody->serialize(),
        ];
    }
}