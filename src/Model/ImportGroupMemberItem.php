<?php

namespace QcloudIM\Model;

class ImportGroupMemberItem
{
    /** @var string 要添加的群成员 ID（必填） */
    public $Member_Account;
    /** @var string 导入成员的角色，目前只有 Admin(可选) */
    public $Role;
    /** @var int  导入的成员入群时间（选填） */
    public $JoinTime;
    /** @var int  该成员的未读消息数（选填） */
    public $UnreadMsgNum;

    /**
     * ImportGroupMemberItem constructor.
     *
     * @param string $Member_Account
     */
    public function __construct(string $Member_Account) { $this->Member_Account = $Member_Account; }

    /**
     * @return string
     */
    public function getMemberAccount(): string
    {
        return $this->Member_Account;
    }

    /**
     * @param string $Member_Account
     */
    public function setMemberAccount(string $Member_Account): void
    {
        $this->Member_Account = $Member_Account;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->Role;
    }

    /**
     * @param string $Role
     */
    public function setRole(string $Role): void
    {
        $this->Role = $Role;
    }

    /**
     * @return int
     */
    public function getJoinTime(): int
    {
        return $this->JoinTime;
    }

    /**
     * @param int $JoinTime
     */
    public function setJoinTime(int $JoinTime): void
    {
        $this->JoinTime = $JoinTime;
    }

    /**
     * @return int
     */
    public function getUnreadMsgNum(): int
    {
        return $this->UnreadMsgNum;
    }

    /**
     * @param int $UnreadMsgNum
     */
    public function setUnreadMsgNum(int $UnreadMsgNum): void
    {
        $this->UnreadMsgNum = $UnreadMsgNum;
    }

}
