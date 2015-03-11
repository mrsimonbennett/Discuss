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
     * @param MemberEmail $email
     */
    public function __construct(MemberEmail $email)
    {
        $this->email = $email;
    }

    /**
     * @return MemberEmail
     */
    public function getEmail()
    {
        return $this->email;
    }
}