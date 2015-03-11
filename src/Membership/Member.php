<?php
namespace Discuss\Membership;

use Discuss\Membership\Events\MemberChangedEmail;
use Discuss\Membership\Events\MemberRegistered;
use InvalidArgumentException;
use ReflectionClass;

/**
 * Class Member
 * @package Discuss\Membership
 * @author  Simon Bennett <simon@bennett.im>
 */
final class Member
{
    /**
     * @var
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
     * @var array $events
     */
    private $events = array();

    /**
     * Applies event and adds it to history
     * @param $event
     */
    private function apply($event)
    {
        $eventName = (new ReflectionClass($event))->getShortName();
        $methodName = "apply{$eventName}";
        if (!is_callable([$this, $methodName]) || $methodName === __METHOD__) {
            throw new InvalidArgumentException(
                "There is no handler registered for {$eventName}"
            );
        }
        $this->{$methodName}($event);
        $this->events[] = $event;
    }

    /**
     * Flushes the array queue and returns the events
     *
     * @return array
     */
    public function releaseEvents()
    {
        $events = $this->events;
        $this->events = [];
        return $events;
    }

    /**
     * @return MemberEmail
     */
    public function getEmail()
    {
        return $this->email;
    }
}