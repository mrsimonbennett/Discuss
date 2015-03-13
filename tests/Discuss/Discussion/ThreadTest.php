<?php
use Discuss\Discussion\Thread;
use Discuss\Discussion\ThreadAuthorId;
use Discuss\Discussion\ThreadBody;
use Discuss\Discussion\ThreadId;
use Discuss\Discussion\ThreadSubject;
use Discuss\Membership\Member;
use Discuss\Membership\MemberEmail;
use Discuss\Membership\MemberId;
use Discuss\Membership\MemberName;

/**
 * Class ThreadTest
 * @author Simon Bennett <simon@bennett.im>
 */
final class ThreadTest extends TestCase
{
    /**
     *
     */
    public function testCreatingANewThread()
    {
        $member = Member::register(MemberId::random(),
            new MemberEmail('simon@bennett.im'),
            new MemberName('Simon Bennett', 'mrsimonbennett'));

        $threadSubject = new ThreadSubject('Event Sourcing');
        $threadBody = new ThreadBody("Lets give this ago");

        $thread = Thread::startThread(
            ThreadId::random(),
            ThreadAuthorId::fromIdentity($member->getId()),
            $threadSubject, $threadBody);

        $this->assertEquals((string)$member->getId(), (string)$thread->getAuthorId());
        $this->assertEquals($threadSubject, $thread->getThreadSubject());
        $this->assertEquals($threadBody, $thread->getThreadBody());
    }
}