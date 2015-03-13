<?php
namespace Discuss\Membership;

use Broadway\Serializer\SerializableInterface;

/**
 * Class MemberName
 * @package Discuss\MemberShip
 * @author Simon Bennett <simon@bennett.im>
 */
final class MemberName implements SerializableInterface
{
    /**
     * @var string
     */
    private $fullName;
    /**
     * @var string
     */
    private $knowBy;

    /**
     * @param string $fullName Members Full Name
     * @param string $knowBy The name the Member wishes to be know by
     */
    public function __construct($fullName, $knowBy)
    {
        $this->fullName = $fullName;
        $this->knowBy = $knowBy;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @return string
     */
    public function getKnowBy()
    {
        return $this->knowBy;
    }


    /**
     * @param array $data
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        return new static($data['fullName'], $data['knowby']);
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return ['fullName' => $this->fullName, 'knowby' => $this->knowBy];
    }
}