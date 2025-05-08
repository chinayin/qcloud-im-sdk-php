<?php

namespace QcloudIM\Api;

use QcloudIM\Constants;
use QcloudIM\Model\CreateContactGroupItem;
use QcloudIM\Model\GetContactGroupItem;
use QcloudIM\Model\UpdateContactGroupItem;
use QcloudIM\Traits\HttpClientTrait;

/**
 * 会话分组.
 */
class RecentContact
{
    use HttpClientTrait;

    /**
     * 创建会话分组数据
     * https://cloud.tencent.com/document/product/269/85791
     */
    public function createContactGroup(CreateContactGroupItem $createContactGroupItem): array
    {
        $params = $createContactGroupItem->toArray();
        return $this->httpClient->postJson('recentcontact/get_contact_group', $params);
    }

    /**
     * 更新会话分组数据
     * https://cloud.tencent.com/document/product/269/85793
     */
    public function updateContactGroup(UpdateContactGroupItem $updateContactGroupItem): bool
    {
        $params = $updateContactGroupItem->toArray();
        $r = $this->httpClient->postJson('recentcontact/update_contact_group', $params);

        return Constants::ACTION_STATUS_OK === $r['ActionStatus'];
    }

    /**
     * 拉取会话分组标记数据
     * https://cloud.tencent.com/document/product/269/85794
     */
    public function getContactGroup(GetContactGroupItem $getContactGroupItem): array
    {
        $params = $getContactGroupItem->toArray();
        return $this->httpClient->postJson('recentcontact/get_contact_group', $params);
    }
}
