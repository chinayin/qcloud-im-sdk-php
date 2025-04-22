<?php

namespace QcloudIM\Api;

use QcloudIM\Constants;
use QcloudIM\Model\UpdateContactGroupItem;
use QcloudIM\Traits\HttpClientTrait;

/**
 * 会话分组.
 */
class RecentContact
{
    use HttpClientTrait;

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
}
