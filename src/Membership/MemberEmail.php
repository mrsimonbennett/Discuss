<?php
namespace Discuss\Membership;

/**
 * Class MemberEmail
 * @package Discuss\Membership
 * @author Simon Bennett <simon@bennett.im>
 */
final class MemberEmail
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

}