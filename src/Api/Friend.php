<?php

namespace QcloudIM\Api;

use QcloudIM\Constants;
use QcloudIM\Model\AddFriendItem;
use QcloudIM\Traits\HttpClientTrait;

/**
 * 关系链管理(好友)
 */
class Friend
{
    use HttpClientTrait;

    /**
     * 添加好友
     *
     * @param string        $fromAccountId
     * @param AddFriendItem $item
     * @param bool          $forceAddFlags 管理员强制加好友标记：1表示强制加好友，0表示常规加好友方式
     * @param string        $addType       加好友方式（默认双向加好友方式）：
     *                                     Add_Type_Single 表示单向加好友
     *                                     Add_Type_Both 表示双向加好友
     *
     * @return array
     */
    public function add(
        string $fromAccountId,
        AddFriendItem $item,
        bool $forceAddFlags = false,
        string $addType = Constants::FRIEND_ADD_TYPE_BOTH
    ): array {
        $p = [
            'From_Account' => $fromAccountId,
            'ForceAddFlags' => $forceAddFlags ? 1 : 0,
            'AddType' => $addType,
            'AddFriendItem' => [
                (array)$item
            ],
        ];
        return $this->httpClient->postJson('sns/friend_add', $p);
    }

    /**
     * 批量添加好友
     *
     * @param string $fromAccountId
     * @param array  $friendItems
     * @param bool   $forceAddFlags
     * @param string $addType
     *
     * @return array
     */
    public function batchAdd(
        string $fromAccountId,
        array $friendItems,
        bool $forceAddFlags = false,
        string $addType = Constants::FRIEND_ADD_TYPE_BOTH
    ): array {
        return $this->httpClient->postJson('sns/friend_add', [
            'From_Account' => $fromAccountId,
            'ForceAddFlags' => $forceAddFlags ? 1 : 0,
            'AddType' => $addType,
            'AddFriendItem' => (array)$friendItems,
        ]);
    }

}
