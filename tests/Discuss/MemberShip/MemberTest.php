<?php
use Discuss\Membership\Member;
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
        $member = $this->buildMember();
        $member->changeEmail(new MemberEmail('simon.bennett@bennett.im'));

        $this->assertEquals('simon.bennett@bennett.im', (string)$member->getEmail());
    }

    public function testRebuildFromEvents()
    {
        $member = $this->buildMember();
        $member->changeEmail(new MemberEmail('simon.bennett@bennett.im'));

        $events = $member->getEvents();
        $memberClone = Member::reconstituteFrom(new \Discuss\Aggregate\AggregateHistory($member->getId(),
            $events));

        $this->assertEquals($member, $memberClone);

    }

    /**
     * @return Member
     */
    private function buildMember()
    {
        $member = Member::register(MemberId::random(),
            new MemberEmail('simon@bennett.im'),
            new MemberName('Simon Bennett', 'MrSimonBennett'));

        return $member;
    }

}