<?php
namespace Discuss\Discussion;

use Broadway\Serializer\SerializableInterface;

/**
 * Class ThreadBody
 * @package Discuss\Discussion
 * @author Simon Bennett <simon@bennett.im>
 */
final class ThreadBody implements SerializableInterface
{
    /**
     * @var string
     */
    private $threadBody;

    /**
     * @param string $threadBody
     */
    public function __construct($threadBody)
    {
        $this->threadBody = $threadBody;
    }

    /**
     * @return string
     */
    public function getThreadBody()
    {
        return $this->threadBody;
    }

    /**
     * @return string
     */
    function __toString()
    {
        return (string)$this->threadBody;
    }

    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        return new static($data['threadBody']);
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return ['threadBody' => $this->threadBody];
    }
}