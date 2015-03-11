<?php
use Discuss\Membership\MemberEmail;
use Discuss\Membership\MemberId;
use Discuss\Membership\MemberName;

/**
 * Class MemberTest
 * @author  Simon Bennett <simon@bennett.im>
 */
final class MemberTest extends \TestCase
{
    public function testUpdatingUsersEmail()
    {
        $member = \Discuss\Membership\Member::register(MemberId::generate(),
                                                       new MemberEmail('simon@bennett.im'),
                                                       new MemberName('Simon Bennett', 'MrSimonBennett'));
        $member->changeEmail(new MemberEmail('simon.bennett@bennett.im'));

        $this->assertEquals('simon.bennett@bennett.im', (string)$member->getEmail());
    }
}