<?php

/**
 * Class MemberIdTest
 * @author  Simon Bennett <simon@bennett.im>
 */
final class MemberIdTest extends \TestCase
{
    /**
     *
     */
    public function testCreatingRandomUuid()
    {
        \Discuss\MemberShip\MemberId::random();
    }

    /**
     *
     */
    public function testCreatingInvalidMembershipId()
    {
        $this->setExpectedException('Discuss\InvalidUuidException');
        \Discuss\MemberShip\MemberId::fromString('invalid');
    }

    /**
     *
     */
    public function testCreatingValidMemberShipIdFromString()
    {
        \Discuss\MemberShip\MemberId::fromString('11111111-1111-1111-1111-111111111111');
    }

    /**
     *
     */
    public function testComparingMemberShipIds()
    {
        $one = \Discuss\MemberShip\MemberId::fromString('11111111-1111-1111-1111-111111111111');
        $two = \Discuss\MemberShip\MemberId::fromString('11111111-1111-1111-1111-111111111111');
        $three = \Discuss\MemberShip\MemberId::random();

        $this->assertTrue($one->equal($two));
        $this->assertFalse($one->equal($three));
    }
}