<?php
namespace Discuss\Membership\Events;

use Broadway\Serializer\SerializableInterface;
use Discuss\Membership\MemberEmail;
use Discuss\Membership\MemberId;
use Discuss\Membership\MemberName;

/**
 * Class MemberRegistered
 * @package Discuss\Membership\Events
 * @author  Simon Bennett <simon@bennett.im>
 */
final class MemberRegistered implements SerializableInterface
{
    /**
     * @var MemberId
     */
    private $id;
    /**
     * @var MemberName
     */
    private $name;
    /**
     * @var MemberEmail
     */
    private $email;

    /**
     * @param MemberId $id
     * @param MemberName $name
     * @param MemberEmail $email
     */
    public function __construct(MemberId $id, MemberEmail $email, MemberName $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @return \Discuss\Membership\MemberId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \Discuss\Membership\MemberName
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return \Discuss\Membership\MemberEmail
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        return new static(
            new MemberId($data['id']),
            MemberEmail::deserialize($data['email']),
            MemberName::deserialize($data['name'])
        );
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return [
            'id' => (string)$this->getId(),
            'name' => $this->getName()->serialize(),
            'email' => $this->getEmail()->serialize(),
        ];
    }
}