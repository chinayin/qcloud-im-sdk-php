<?php

namespace QcloudIM\Api;

use QcloudIM\Constants;
use QcloudIM\Traits\HttpClientTrait;

/**
 * 关系链管理(好友黑名单).
 */
class FriendBlacklist
{
    use HttpClientTrait;

    /**
     * 添加黑名单.
     */
    public function add(
        string $fromAccountId,
        array $toAccountIds
    ): array {
        if (count($toAccountIds) > 1000) {
            throw new \InvalidArgumentException('AccountIds size limit exceeded.', -1);
        }

        return $this->httpClient->postJson('sns/black_list_add', [
            'From_Account' => $fromAccountId,
            'To_Account' => $toAccountIds,
        ]);
    }

    /**
     * 删除黑名单.
     */
    public function delete(
        string $fromAccountId,
        array $toAccountIds
    ): array {
        if (count($toAccountIds) > 1000) {
            throw new \InvalidArgumentException('AccountIds size limit exceeded.', -1);
        }

        return $this->httpClient->postJson('sns/black_list_delete', [
            'From_Account' => $fromAccountId,
            'To_Account' => $toAccountIds,
        ]);
    }

    /**
     * 拉取黑名单.
     */
    public function get(
        string $fromAccountId,
        int $startIndex,
        int $lastSequence = 0,
        int $maxLimited = 50
    ): array {
        return $this->httpClient->postJson('sns/black_list_get', [
            'From_Account' => $fromAccountId,
            'StartIndex' => $startIndex,
            'LastSequence' => $lastSequence,
            'MaxLimited' => $maxLimited,
        ]);
    }

    /**
     * 校验黑名单.
     */
    public function check(
        string $fromAccountId,
        array $toAccountIds,
        string $checkType = Constants::BLACK_CHECK_TYPE_BOTH
    ): array {
        return $this->httpClient->postJson('sns/black_list_check', [
            'From_Account' => $fromAccountId,
            'To_Account' => $toAccountIds,
            'CheckType' => $checkType,
        ]);
    }
}
