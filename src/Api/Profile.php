<?php

namespace QcloudIM\Api;

use QcloudIM\Traits\HttpClientTrait;

/**
 * 资料管理.
 */
class Profile
{
    use HttpClientTrait;

    /**
     * 获取资料.
     */
    public function get(string $accountId, array $tags): array
    {
        $r = $this->httpClient->postJson('profile/portrait_get', [
            'To_Account' => [$accountId],
            'TagList' => $tags,
        ]);

        return $r['UserProfileItem'][0];
    }

    /**
     * 批量获取资料.
     */
    public function batchGet(array $accountIds, array $tags): array
    {
        $r = $this->httpClient->postJson('profile/portrait_get', [
            'To_Account' => $accountIds,
            'TagList' => $tags,
        ]);

        return $r['UserProfileItem'];
    }

    /**
     * 设置资料.
     */
    public function set(string $accountId, array $items): array
    {
        return $this->httpClient->postJson('profile/portrait_set', [
            'From_Account' => $accountId,
            'ProfileItem' => $items,
        ]);
    }
}
