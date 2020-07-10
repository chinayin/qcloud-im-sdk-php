<?php

namespace QcloudIM\Model;

class ModifyGroupMemberInfoItem
{
    /** @var string    必填    操作群ID */
    public $GroupId;
    /** @var string    必填    要操作的群成员 */
    public $Member_Account;
    /** @var string    选填    成员身份，Admin/Member 分别为设置/取消管理员 */
    public $Role;
    /** @var string    选填    消息屏蔽类型 */
    public $MsgFlag;
    /** @var string    选填    群名片（最大不超过50个字节） */
    public $NameCard;
    /** @var int    选填    需禁言时间，单位为秒，0表示取消禁言 */
    public $ShutUpTime;
    /** @var array    选填    群成员维度的自定义字段，默认情况是没有的，需要开通 */
    public $AppMemberDefinedData;

    /**
     * ModifyGroupMemberInfoItem constructor.
     *
     * @param string $GroupId
     * @param string $Member_Account
     */
    public function __construct(string $GroupId, string $Member_Account)
    {
        $this->GroupId = $GroupId;
        $this->Member_Account = $Member_Account;
    }

    /**
     * @return string
     */
    public function getGroupId(): string
    {
        return $this->GroupId;
    }

    /**
     * @param string $GroupId
     */
    public function setGroupId(string $GroupId): void
    {
        $this->GroupId = $GroupId;
    }

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
     * @return string
     */
    public function getMsgFlag(): string
    {
        return $this->MsgFlag;
    }

    /**
     * @param string $MsgFlag
     */
    public function setMsgFlag(string $MsgFlag): void
    {
        $this->MsgFlag = $MsgFlag;
    }

    /**
     * @return string
     */
    public function getNameCard(): string
    {
        return $this->NameCard;
    }

    /**
     * @param string $NameCard
     */
    public function setNameCard(string $NameCard): void
    {
        $this->NameCard = $NameCard;
    }

    /**
     * @return int
     */
    public function getShutUpTime(): int
    {
        return $this->ShutUpTime;
    }

    /**
     * @param int $ShutUpTime
     */
    public function setShutUpTime(int $ShutUpTime): void
    {
        $this->ShutUpTime = $ShutUpTime;
    }

    /**
     * @return array
     */
    public function getAppMemberDefinedData(): array
    {
        return $this->AppMemberDefinedData;
    }

    /**
     * @param array $AppMemberDefinedData
     */
    public function setAppMemberDefinedData(array $AppMemberDefinedData): void
    {
        $this->AppMemberDefinedData = $AppMemberDefinedData;
    }

    /**
     * @param KeyValueItem $item
     */
    public function addAppMemberDefinedDataItem(KeyValueItem $item): void
    {
        is_array($this->AppMemberDefinedData) or $this->AppMemberDefinedData = [];
        $this->AppMemberDefinedData[] = $item;
    }

    /**
     * @param string $key
     * @param        $value
     */
    public function addAppMemberDefinedDataValue(string $key, $value): void
    {
        $this->addAppMemberDefinedDataItem(new KeyValueItem($key, $value));
    }

}
