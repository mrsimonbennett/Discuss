<?php
namespace Discuss\Membership;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Discuss\Membership\Events\MemberChangedEmail;
use Discuss\Membership\Events\MemberRegistered;

/**
 * Class Member
 * @package Discuss\Membership
 * @author  Simon Bennett <simon@bennett.im>
 */
class Member extends EventSourcedAggregateRoot
{
    /**
     * @var MemberId
     */
    protected $id;
    /**
     * @var MemberEmail
     */
    private $email;
    /**
     * @var MemberName
     */
    private $name;

    /**
     * @param MemberId $id
     * @param MemberEmail $email
     * @param MemberName $name
     * @return static
     */
    public static function register(MemberId $id, MemberEmail $email, MemberName $name)
    {
        $member = new static();
        $member->apply(new MemberRegistered($id, $email, $name));

        return $member;
    }

    /**
     * @param MemberEmail $email
     */
    public function changeEmail(MemberEmail $email)
    {
        if ($email == $this->getEmail()) {
            return;
        }
        $this->apply(new MemberChangedEmail($this->id, $email));
    }
    /**
     * Event Application
     */
    /**
     * @param MemberRegistered $memberRegistered
     */
    public function applyMemberRegistered(MemberRegistered $memberRegistered)
    {
        $this->id = $memberRegistered->getId();
        $this->email = $memberRegistered->getEmail();
        $this->name = $memberRegistered->getName();
    }

    /**
     * @param MemberChangedEmail $memberEmailChanged
     */
    public function applyMemberChangedEmail(MemberChangedEmail $memberEmailChanged)
    {
        $this->email = $memberEmailChanged->getEmail();
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAggregateRootId()
    {
        return $this->id;
    }
}