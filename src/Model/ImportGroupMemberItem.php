<?php

namespace QcloudIM\Model;

class ImportGroupMemberItem extends Model
{
    /** @var string 要添加的群成员 ID（必填） */
    public $Member_Account;
    /** @var string 导入成员的角色，目前只有 Admin(可选) */
    public $Role;
    /** @var int 导入的成员入群时间（选填） */
    public $JoinTime;
    /** @var int 该成员的未读消息数（选填） */
    public $UnreadMsgNum;

    /**
     * ImportGroupMemberItem constructor.
     */
    public function __construct(string $Member_Account)
    {
        $this->Member_Account = $Member_Account;
    }

    public function getMemberAccount(): string
    {
        return $this->Member_Account;
    }

    public function setMemberAccount(string $Member_Account): void
    {
        $this->Member_Account = $Member_Account;
    }

    public function getRole(): string
    {
        return $this->Role;
    }

    public function setRole(string $Role): void
    {
        $this->Role = $Role;
    }

    public function getJoinTime(): int
    {
        return $this->JoinTime;
    }

    public function setJoinTime(int $JoinTime): void
    {
        $this->JoinTime = $JoinTime;
    }

    public function getUnreadMsgNum(): int
    {
        return $this->UnreadMsgNum;
    }

    public function setUnreadMsgNum(int $UnreadMsgNum): void
    {
        $this->UnreadMsgNum = $UnreadMsgNum;
    }
}
