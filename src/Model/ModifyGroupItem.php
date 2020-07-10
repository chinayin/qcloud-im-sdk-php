<?php

namespace QcloudIM\Model;

class ModifyGroupItem
{
    /** @var string    必填    为了使得群组 ID 更加简单，便于记忆传播，腾讯云支持 App 在通过 REST API 创建群组时 自定义群组 ID */
    public $GroupId;
    /** @var string    必填    群名称，最长30字节，使用 UTF-8 编码，1个汉字占3个字节 */
    public $Name;
    /** @var string    选填    群简介，最长240字节，使用 UTF-8 编码，1个汉字占3个字节 */
    public $Introduction;
    /** @var string    选填    群公告，最长300字节，使用 UTF-8 编码，1个汉字占3个字节 */
    public $Notification;
    /** @var string    选填    群头像 URL，最长100字节 */
    public $FaceUrl;
    /** @var int    选填    最大群成员数量，缺省时的默认值：私有群是200，公开群是2000，聊天室是6000，音视频聊天室和在线成员广播大群无限制 */
    public $MaxMemberCount;
    /** @var string    选填    申请加群处理方式。包含 FreeAccess（自由加入），NeedPermission（需要验证），DisableApply（禁止加群），不填默认为 NeedPermission（需要验证）仅当创建支持申请加群的 群组 时，该字段有效 */
    public $ApplyJoinOption;
    /** @var array    选填    群组维度的自定义字段，默认情况是没有的，需要开通，详情请参阅 自定义字段 */
    public $AppDefinedData;

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
    public function getName(): string
    {
        return $this->Name;
    }

    /**
     * @param string $Name
     */
    public function setName(string $Name): void
    {
        $this->Name = $Name;
    }

    /**
     * @return string
     */
    public function getIntroduction(): string
    {
        return $this->Introduction;
    }

    /**
     * @param string $Introduction
     */
    public function setIntroduction(string $Introduction): void
    {
        $this->Introduction = $Introduction;
    }

    /**
     * @return string
     */
    public function getNotification(): string
    {
        return $this->Notification;
    }

    /**
     * @param string $Notification
     */
    public function setNotification(string $Notification): void
    {
        $this->Notification = $Notification;
    }

    /**
     * @return string
     */
    public function getFaceUrl(): string
    {
        return $this->FaceUrl;
    }

    /**
     * @param string $FaceUrl
     */
    public function setFaceUrl(string $FaceUrl): void
    {
        $this->FaceUrl = $FaceUrl;
    }

    /**
     * @return int
     */
    public function getMaxMemberCount(): int
    {
        return $this->MaxMemberCount;
    }

    /**
     * @param int $MaxMemberCount
     */
    public function setMaxMemberCount(int $MaxMemberCount): void
    {
        $this->MaxMemberCount = $MaxMemberCount;
    }

    /**
     * @return string
     */
    public function getApplyJoinOption(): string
    {
        return $this->ApplyJoinOption;
    }

    /**
     * @param string $ApplyJoinOption
     */
    public function setApplyJoinOption(string $ApplyJoinOption): void
    {
        $this->ApplyJoinOption = $ApplyJoinOption;
    }

    /**
     * @return array
     */
    public function getAppDefinedData(): array
    {
        return $this->AppDefinedData;
    }

    /**
     * @param array $AppDefinedData
     */
    public function setAppDefinedData(array $AppDefinedData): void
    {
        $this->AppDefinedData = $AppDefinedData;
    }

    /**
     * @param KeyValueItem $item
     */
    public function addAppDefinedDataItem(KeyValueItem $item): void
    {
        is_array($this->AppDefinedData) or $this->AppDefinedData = [];
        $this->AppDefinedData[] = $item;
    }

    /**
     * @param string $key
     * @param        $value
     */
    public function addAppDefinedDataValue(string $key, $value): void
    {
        $this->addAppDefinedDataItem(new KeyValueItem($key, $value));
    }

}
