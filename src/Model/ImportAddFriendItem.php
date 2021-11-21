<?php

namespace QcloudIM\Model;

use QcloudIM\Constants;

class ImportAddFriendItem
{
    /** @var string */
    public $To_Account;
    /** @var string */
    public $AddSource;
    /** @var int From_Account 和 To_Account 形成好友关系的时间 */
    public $AddTime;
    /** @var string From_Account 对 To_Account 的好友备注，详情可参见 标配好友字段 */
    public $Remark = '';
    /** @var string From_Account 和 To_Account 形成好友关系时的附言信息 */
    public $AddWording = '';
    /** @var int From_Account 对 To_Account 的好友备注时间 */
    public $RemarkTime = 0;
    /** @var string 不能为空 From_Account 对 To_Account 的分组信息，添加好友时只允许设置一个分组，因此使用 String 类型即可 */
//    public $GroupName ;
    /** @var array From_Account 对 To_Account 的自定义好友数据，每一个成员都包含一个 Tag 字段和一个 Value 字段，详情可参见 自定义好友字段 */
//    public $CustomItem ;

    /**
     * AddFriendItem constructor.
     */
    public function __construct(string $To_Account, string $AddSource, int $AddTime)
    {
        $this->To_Account = $To_Account;
        $this->setAddSource($AddSource);
        $this->AddTime = $AddTime;
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

    public function getRemarkTime(): int
    {
        return $this->RemarkTime;
    }

    public function setRemarkTime(int $RemarkTime): void
    {
        $this->RemarkTime = $RemarkTime;
    }

    public function getAddTime(): int
    {
        return $this->AddTime;
    }

    public function setAddTime(int $AddTime): void
    {
        $this->AddTime = $AddTime;
    }

    // @return array
//    public function getCustomItem(): array
//    {
//        return $this->CustomItem;
//    }
//
//    /**
//     * @param array $CustomItem
//     */
//    public function setCustomItem(array $CustomItem): void
//    {
//        $this->CustomItem = $CustomItem;
//    }
//
//    /**
//     * @param TagValueItem $item
//     */
//    public function addCustomItem(TagValueItem $item): void
//    {
//        is_array($this->CustomItem) or $this->CustomItem = [];
//        $this->CustomItem[] = $item;
//    }
//
//    /**
//     * @param string $key
//     * @param        $value
//     */
//    public function addCustomItemValue(string $key, $value): void
//    {
//        $this->addCustomItem(new TagValueItem($key, $value));
//    }
}
