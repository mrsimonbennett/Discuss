<?php
namespace Discuss\Discussion;

use Broadway\Serializer\SerializableInterface;

/**
 * Class ThreadSubject
 * @package Discuss\Discussion
 * @author Simon Bennett <simon@bennett.im>
 */
final class ThreadSubject implements SerializableInterface
{
    /**
     * @var string
     */
    private $subject;

    /**
     * @param string $subject
     */
    public function __construct($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    function __toString()
    {
        return (string)$this->subject;
    }

    /**
     * @param array $data
     * @return static
     */
    public static function deserialize(array $data)
    {
        return new static($data['subject']);
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return ['subject' => $this->subject];
    }
}