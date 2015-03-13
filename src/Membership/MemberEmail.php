<?php
namespace Discuss\Membership;

use Broadway\Serializer\SerializableInterface;

/**
 * Class MemberEmail
 * @package Discuss\Membership
 * @author Simon Bennett <simon@bennett.im>
 */
final class MemberEmail implements SerializableInterface
{
    /**
     * @var string
     */
    private $email;

    /**
     * @param string $email
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    function __toString()
    {
        return (string)$this->email;
    }

    /**
     * @param array $data
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        return new static($data['email']);
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return ['email' => $this->email];
    }
}