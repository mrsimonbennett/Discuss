<?php
namespace Discuss\Membership;

use Discuss\Aggregate\AggregateHistory;
use Discuss\Aggregate\AggregateRoot;
use Discuss\Membership\Events\MemberChangedEmail;
use Discuss\Membership\Events\MemberRegistered;

/**
 * Class Member
 * @package Discuss\Membership
 * @author  Simon Bennett <simon@bennett.im>
 */
final class Member
{
    use AggregateRoot;
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

    private function __construct(MemberId $id)
    {
        $this->id = $id;
    }
    /**
     * @param MemberId $id
     * @param MemberEmail $email
     * @param MemberName $name
     * @return static
     */
    public static function register(MemberId $id, MemberEmail $email, MemberName $name)
    {
        $member = new static($id);
        $member->apply(new MemberRegistered($id, $email, $name));

        return $member;
    }

    /**
     * @param MemberEmail $email
     */
    public function changeEmail(MemberEmail $email)
    {
        $this->apply(new MemberChangedEmail($this->id, $email));
    }

    /**
     * @return MemberId
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Event Application
     */
    /**
     * @param MemberRegistered $memberRegistered
     */
    private function applyMemberRegistered(MemberRegistered $memberRegistered)
    {
        $this->email = $memberRegistered->getEmail();
        $this->name = $memberRegistered->getName();
    }

    /**
     * @param MemberChangedEmail $memberEmailChanged
     */
    private function applyMemberChangedEmail(MemberChangedEmail $memberEmailChanged)
    {
        $this->email = $memberEmailChanged->getEmail();
    }
    public static function reconstituteFrom(AggregateHistory $aggregateHistory)
    {
        $memberId = $aggregateHistory->getAggregateId();
        $member = new Member($memberId);
        foreach($aggregateHistory as $event)
        {
            $member->apply($event);
        }
        return $member;
    }

    /**
     * @return MemberEmail
     */
    public function getEmail()
    {
        return $this->email;
    }
}