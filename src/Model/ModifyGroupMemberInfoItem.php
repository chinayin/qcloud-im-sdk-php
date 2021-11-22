<?php

namespace QcloudIM\Model;

class ModifyGroupMemberInfoItem extends Model
{
    /** @var string 必填    操作群ID */
    public $GroupId;
    /** @var string 必填    要操作的群成员 */
    public $Member_Account;
    /** @var string 选填    成员身份，Admin/Member 分别为设置/取消管理员 */
    public $Role;
    /** @var string 选填    消息屏蔽类型 */
    public $MsgFlag;
    /** @var string 选填    群名片（最大不超过50个字节） */
    public $NameCard;
    /** @var int 选填    需禁言时间，单位为秒，0表示取消禁言 */
    public $ShutUpTime;
    /** @var array 选填    群成员维度的自定义字段，默认情况是没有的，需要开通 */
    public $AppMemberDefinedData;

    /**
     * ModifyGroupMemberInfoItem constructor.
     */
    public function __construct(string $GroupId, string $Member_Account)
    {
        $this->GroupId = $GroupId;
        $this->Member_Account = $Member_Account;
    }

    public function getGroupId(): string
    {
        return $this->GroupId;
    }

    public function setGroupId(string $GroupId): void
    {
        $this->GroupId = $GroupId;
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

    public function getMsgFlag(): string
    {
        return $this->MsgFlag;
    }

    public function setMsgFlag(string $MsgFlag): void
    {
        $this->MsgFlag = $MsgFlag;
    }

    public function getNameCard(): string
    {
        return $this->NameCard;
    }

    public function setNameCard(string $NameCard): void
    {
        $this->NameCard = $NameCard;
    }

    public function getShutUpTime(): int
    {
        return $this->ShutUpTime;
    }

    public function setShutUpTime(int $ShutUpTime): void
    {
        $this->ShutUpTime = $ShutUpTime;
    }

    public function getAppMemberDefinedData(): array
    {
        return $this->AppMemberDefinedData;
    }

    public function setAppMemberDefinedData(array $AppMemberDefinedData): void
    {
        $this->AppMemberDefinedData = $AppMemberDefinedData;
    }

    public function addAppMemberDefinedDataItem(KeyValueItem $item): void
    {
        if (!is_array($this->AppMemberDefinedData)) {
            $this->AppMemberDefinedData = [];
        }
        $this->AppMemberDefinedData[] = $item;
    }

    /**
     * @param $value
     */
    public function addAppMemberDefinedDataValue(string $key, $value): void
    {
        $this->addAppMemberDefinedDataItem(new KeyValueItem($key, $value));
    }
}
