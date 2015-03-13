<?php
namespace Discuss\Membership\Events;

use Broadway\Serializer\SerializableInterface;
use Discuss\Membership\MemberEmail;
use Discuss\Membership\MemberId;

/**
 * Class MemberChangedEmail
 * @package Discuss\Membership\Events
 * @author  Simon Bennett <simon@bennett.im>
 */
final class MemberChangedEmail implements SerializableInterface
{
    /**
     * @var MemberEmail
     */
    private $email;
    /**
     * @var MemberId
     */
    private $memberId;

    /**
     * @param MemberId $memberId
     * @param MemberEmail $email
     */
    public function __construct(MemberId $memberId, MemberEmail $email)
    {
        $this->email = $email;
        $this->memberId = $memberId;
    }

    /**
     * @return MemberEmail
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return MemberId
     */
    public function getMemberId()
    {
        return $this->memberId;
    }

    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        return new static(MemberId::fromString($data['id']), MemberEmail::deserialize($data['email']));
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return ['id' => (string)$this->getMemberId(), 'email' => $this->getEmail()->serialize()];
    }
}