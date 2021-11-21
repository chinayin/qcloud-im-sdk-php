<?php

namespace QcloudIM\Model;

use QcloudIM\Constants;

class AddFriendItem extends Model
{
    /** @var string */
    public $To_Account;
    /** @var string */
    public $AddSource;
    /** @var string From_Account 对 To_Account 的好友备注，详情可参见 标配好友字段 */
    public $Remark = '';
    /** @var string From_Account 和 To_Account 形成好友关系时的附言信息 */
    public $AddWording = '';
    /** @var string 不能为空 From_Account 对 To_Account 的分组信息，添加好友时只允许设置一个分组，因此使用 String 类型即可 */
    public $GroupName;

    /**
     * AddFriendItem constructor.
     */
    public function __construct(string $To_Account, string $AddSource)
    {
        $this->To_Account = $To_Account;
        $this->setAddSource($AddSource);
    }

    public function getToAccount(): string
    {
        return $this->To_Account;
    }

    public function setToAccount(string $To_Account): void
    {
        $this->To_Account = $To_Account;
    }

    public function getRemark(): string
    {
        return $this->Remark;
    }

    public function setRemark(string $Remark): void
    {
        $this->Remark = $Remark;
    }

    public function getGroupName(): string
    {
        return $this->GroupName;
    }

    public function setGroupName(string $GroupName): void
    {
        $this->GroupName = $GroupName;
    }

    public function getAddSource(): string
    {
        return $this->AddSource;
    }

    public function setAddSource(string $AddSource): void
    {
        $this->AddSource = Constants::ADD_SOURCE_TYPE_PREFIX.strtolower($AddSource);
    }

    public function getAddWording(): string
    {
        return $this->AddWording;
    }

    public function setAddWording(string $AddWording): void
    {
        $this->AddWording = $AddWording;
    }
}
