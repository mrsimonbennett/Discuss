<?php
namespace Discuss\Membership\Events;
use Discuss\Membership\MemberEmail;
use Discuss\Membership\MemberId;

/**
 * Class MemberEmailChanged
 * @package Discuss\Membership\Events
 * @author  Simon Bennett <simon@bennett.im>
 */
final class MemberEmailChanged
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

}