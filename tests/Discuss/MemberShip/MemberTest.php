<?php

/**
 * Class MemberTest
 * @author  Simon Bennett <simon@bennett.im>
 */
final class MemberTest extends \TestCase
{
    public function testUpdatingUsersEmail()
    {
        $member = new \Discuss\Membership\Member(new \Discuss\Membership\MemberEmail('simon@bennett.im'),new \Discuss\Membership\MemberName('Simon Bennett','MrSimonBennett'));
        $member->changeEmail(new \Discuss\Membership\MemberEmail('simon.bennett@bennett.im'));

        $this->assertEquals('simon.bennett@bennett.im', (string)$member->getEmail());
    }
}