<?php
use Discuss\Discussion\Author;
use Discuss\Discussion\AuthorId;
use Discuss\Discussion\Thread;
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
        $member = $this->buildMember();

        list($threadSubject, $threadBody) = $this->CreateThreadBodyAndContent();

        $thread = Thread::openThread(
            ThreadId::random(),
            new Author(AuthorId::fromIdentity($member->getId())),
            $threadSubject, $threadBody);


        $events = $thread->getUncommittedEvents()->getIterator();
        $this->assertCount(1, $events);

        /** @var \Discuss\Discussion\Events\ThreadDiscussesBegun $threadDiscusesBegunEvent */
        $threadDiscusesBegunEvent = $events[0]->getPayload();

        $this->assertInstanceOf(\Discuss\Discussion\Events\ThreadDiscussesBegun::class, $threadDiscusesBegunEvent);
        $this->assertEquals($threadBody,$threadDiscusesBegunEvent->getThreadBody());

    }

    public function testOpeningThreadFromAuthor()
    {
        $author = new Author(AuthorId::random());

        list($threadSubject, $threadBody) = $this->CreateThreadBodyAndContent();

        $author->openThread(ThreadId::random(), $threadSubject, $threadBody);
    }

    /**
     * @return static
     */
    protected function buildMember()
    {
        $member = Member::register(MemberId::random(),
            new MemberEmail('simon@bennett.im'),
            new MemberName('Simon Bennett', 'mrsimonbennett'));

        return $member;
    }

    /**
     * @return array
     */
    protected function CreateThreadBodyAndContent()
    {
        $threadSubject = new ThreadSubject('Event Sourcing');
        $threadBody = new ThreadBody("Lets give this ago");

        return array($threadSubject, $threadBody);
    }
}