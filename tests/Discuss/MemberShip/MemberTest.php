<?php
use Discuss\Membership\Member;
use Discuss\Membership\MemberEmail;
use Discuss\Membership\MemberId;
use Discuss\Membership\MemberName;
use Discuss\Membership\MemberRepository;

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

    public function testEventStore()
    {

        /** @var MemberRepository $memberRepo */
       // $memberRepo = $this->app->make(MemberRepository::class);


        /** @var Member $member */
       // $member = $memberRepo->load(new MemberId('9793f26b-b8c7-42bb-bce1-702e1355fb21'));
        //$member->changeEmail(new MemberEmail('simon.bennett@bennett.im'));
      //  $memberRepo->save($member);


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