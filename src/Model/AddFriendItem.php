<?php

namespace QcloudIM\Model;

use QcloudIM\Constants;

class AddFriendItem
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
//    public $GroupName ;

    /**
     * AddFriendItem constructor.
     *
     * @param string $To_Account
     * @param string $AddSource
     */
    public function __construct(string $To_Account, string $AddSource)
    {
        $this->To_Account = $To_Account;
        $this->setAddSource($AddSource);
    }

    /**
     * @return string
     */
    public function getToAccount(): string
    {
        return $this->To_Account;
    }

    /**
     * @param string $To_Account
     */
    public function setToAccount(string $To_Account): void
    {
        $this->To_Account = $To_Account;
    }

    /**
     * @return string
     */
    public function getRemark(): string
    {
        return $this->Remark;
    }

    /**
     * @param string $Remark
     */
    public function setRemark(string $Remark): void
    {
        $this->Remark = $Remark;
    }

    /**
     * @return string
     */
//    public function getGroupName(): string
//    {
//        return $this->GroupName;
//    }
//
//    /**
//     * @param string $GroupName
//     */
//    public function setGroupName(string $GroupName): void
//    {
//        $this->GroupName = $GroupName;
//    }

    /**
     * @return string
     */
    public function getAddSource(): string
    {
        return $this->AddSource;
    }

    /**
     * @param string $AddSource
     */
    public function setAddSource(string $AddSource): void
    {
        $this->AddSource = Constants::ADD_SOURCE_TYPE_PREFIX . strtolower($AddSource);
    }

    /**
     * @return string
     */
    public function getAddWording(): string
    {
        return $this->AddWording;
    }

    /**
     * @param string $AddWording
     */
    public function setAddWording(string $AddWording): void
    {
        $this->AddWording = $AddWording;
    }

}
