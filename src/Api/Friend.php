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
                $item->toArray()
            ],
        ];
        return $this->httpClient->postJson('sns/friend_add', $p);
    }

    /**
     * 批量添加好友
     *
     * @param string $fromAccountId
     * @param array  $items
     * @param bool   $forceAddFlags
     * @param string $addType
     *
     * @return array
     */
    public function batchAdd(
        string $fromAccountId,
        array $items,
        bool $forceAddFlags = false,
        string $addType = Constants::FRIEND_ADD_TYPE_BOTH
    ): array {
        return $this->httpClient->postJson('sns/friend_add', [
            'From_Account' => $fromAccountId,
            'ForceAddFlags' => $forceAddFlags ? 1 : 0,
            'AddType' => $addType,
            'AddFriendItem' => array_map(function ($v) {
                return $v->toArray();
            }, $items),
        ]);
    }

    /**
     * 拉取好友
     *
     * @param string $fromAccountId
     * @param int    $StartIndex       分页的起始位置
     * @param int    $StandardSequence 上次拉好友数据时返回的 StandardSequence，如果 StandardSequence 字段的值与后台一致，后台不会返回标配好友数据
     * @param int    $CustomSequence   上次拉好友数据时返回的 CustomSequence，如果 CustomSequence 字段的值与后台一致，后台不会返回自定义好友数据
     *
     * @return array
     */
    public function get(
        string $fromAccountId,
        int $StartIndex,
        int $StandardSequence = 0,
        int $CustomSequence = 0
    ): array {
        $p = [
            'From_Account' => $fromAccountId,
            'StartIndex' => $StartIndex,
        ];
        empty($StandardSequence) or $p['StandardSequence'] = $StandardSequence;
        empty($CustomSequence) or $p['CustomSequence'] = $CustomSequence;
        return $this->httpClient->postJson('sns/friend_get', $p);
    }

    /**
     * 删除好友
     *
     * @param string $fromAccountId
     * @param array  $toAccountIds
     * @param string $deleteType
     *
     * @return array
     */
    public function delete(
        string $fromAccountId,
        array $toAccountIds,
        string $deleteType = Constants::FRIEND_DELETE_TYPE_BOTH
    ): array {
        return $this->httpClient->postJson('sns/friend_delete', [
            'From_Account' => $fromAccountId,
            'To_Account' => $toAccountIds,
            'DeleteType' => $deleteType,
        ]);
    }

    /**
     * 删除所有好友
     *
     * @param string $fromAccountId
     * @param string $deleteType
     *
     * @return bool
     */
    public function deleteAll(
        string $fromAccountId,
        string $deleteType = Constants::FRIEND_DELETE_TYPE_SIGNLE
    ): bool {
        $r = $this->httpClient->postJson('sns/friend_delete_all', [
            'From_Account' => $fromAccountId,
            'DeleteType' => $deleteType,
        ]);
        return $r['ActionStatus'] === Constants::ACTION_STATUS_OK;
    }

    /**
     * 更新好友
     *
     * @param string $fromAccountId
     * @param string $toAccountId
     * @param array  $tags
     *
     * @return array
     */
    public function update(
        string $fromAccountId,
        string $toAccountId,
        array $tags
    ): array {
        return $this->httpClient->postJson('sns/friend_update', [
            'From_Account' => $fromAccountId,
            'UpdateItem' => [
                [
                    'To_Account' => $toAccountId,
                    'SnsItem' => array_map(function ($v) { return $v->toArray(); }, $tags)
                ]
            ],
        ]);
    }

    /**
     * 批量更新好友
     *
     * @param string $fromAccountId
     * @param array  $items
     *
     * @return array
     */
    public function batchUpdate(
        string $fromAccountId,
        array $items
    ): array {
        return $this->httpClient->postJson('sns/friend_update', [
            'From_Account' => $fromAccountId,
            'UpdateItem' => array_map(function ($v) {
                return [
                    'To_Account' => $v['To_Account'],
                    'SnsItem' => $v['SnsItem']->toArray(),
                ];
            }, $items),
        ]);
    }

    /**
     * 批量导入好友
     *
     * @param string $fromAccountId
     * @param array  $items
     *
     * @return array
     */
    public function import(
        string $fromAccountId,
        array $items
    ): array {
        return $this->httpClient->postJson('sns/friend_import', [
            'From_Account' => $fromAccountId,
            'AddFriendItem' => array_map(function ($v) { return $v->toArray(); }, $items),
        ]);
    }

    /**
     * 校验好友
     *
     * @param string $fromAccountId
     * @param array  $toAccountIds
     * @param string $checkType
     *
     * @return array
     */
    public function check(
        string $fromAccountId,
        array $toAccountIds,
        string $checkType = Constants::FRIEND_CHECK_TYPE_BOTH
    ): array {
        if (count($toAccountIds) > 1000) {
            throw new \InvalidArgumentException('AccountIds size limit exceeded.', -1);
        }
        return $this->httpClient->postJson('sns/friend_check', [
            'From_Account' => $fromAccountId,
            'To_Account' => $toAccountIds,
            'CheckType' => $checkType,
        ]);
    }

}
