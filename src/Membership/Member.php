<?php
namespace Discuss\Membership;
use Discuss\Membership\Events\MemberEmailChanged;
use ReflectionClass;
use InvalidArgumentException;

/**
 * Class Member
 * @package Discuss\Membership
 * @author  Simon Bennett <simon@bennett.im>
 */
final class Member 
{
    /**
     * @var MemberEmail
     */
    private $email;
    /**
     * @var MemberName
     */
    private $name;

    /**
     * @param MemberEmail $email
     * @param MemberName $name
     */
    public function __construct(MemberEmail $email, MemberName $name)
    {
        $this->id = MemberId::random();
        $this->email = $email;
        $this->name = $name;
    }
    public function changeEmail(MemberEmail $email)
    {
        $this->apply(new MemberEmailChanged($email));
    }

    public function applyMemberEmailChanged(MemberEmailChanged $memberEmailChanged)
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

    public function getEmail()
    {
        return $this->email;
    }
}