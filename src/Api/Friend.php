<?php

namespace QcloudIM\Api;

use QcloudIM\Constants;
use QcloudIM\Model\AddFriendItem;
use QcloudIM\Traits\HttpClientTrait;

/**
 * 关系链管理(好友).
 */
class Friend
{
    use HttpClientTrait;

    /**
     * 添加好友.
     *
     * @param bool $forceAddFlags 管理员强制加好友标记：1表示强制加好友，0表示常规加好友方式
     * @param string $addType 加好友方式（默认双向加好友方式）：
     *                              Add_Type_Single 表示单向加好友
     *                              Add_Type_Both 表示双向加好友
     */
    public function add(
        string        $fromAccountId,
        AddFriendItem $item,
        bool          $forceAddFlags = false,
        string        $addType = Constants::FRIEND_ADD_TYPE_BOTH
    ): array
    {
        $p = [
            'From_Account' => $fromAccountId,
            'ForceAddFlags' => $forceAddFlags ? 1 : 0,
            'AddType' => $addType,
            'AddFriendItem' => [
                (array)$item,
            ],
        ];

        return $this->httpClient->postJson('sns/friend_add', $p);
    }

    /**
     * 批量添加好友.
     */
    public function batchAdd(
        string $fromAccountId,
        array  $friendItems,
        bool   $forceAddFlags = false,
        string $addType = Constants::FRIEND_ADD_TYPE_BOTH
    ): array
    {
        return $this->httpClient->postJson('sns/friend_add', [
            'From_Account' => $fromAccountId,
            'ForceAddFlags' => $forceAddFlags ? 1 : 0,
            'AddType' => $addType,
            'AddFriendItem' => (array)$friendItems,
        ]);
    }

    /**
     * 拉取好友.
     *
     * @param int $StartIndex 分页的起始位置
     * @param int $StandardSequence 上次拉好友数据时返回的 StandardSequence，如果 StandardSequence 字段的值与后台一致，后台不会返回标配好友数据
     * @param int $CustomSequence 上次拉好友数据时返回的 CustomSequence，如果 CustomSequence 字段的值与后台一致，后台不会返回自定义好友数据
     */
    public function get(
        string $fromAccountId,
        int    $StartIndex,
        int    $StandardSequence = 0,
        int    $CustomSequence = 0
    ): array
    {
        $p = [
            'From_Account' => $fromAccountId,
            'StartIndex' => $StartIndex,
        ];
        empty($StandardSequence) or $p['StandardSequence'] = $StandardSequence;
        empty($CustomSequence) or $p['CustomSequence'] = $CustomSequence;

        return $this->httpClient->postJson('sns/friend_get', $p);
    }

    /**
     * 删除好友.
     */
    public function delete(
        string $fromAccountId,
        array  $toAccountIds,
        string $deleteType = Constants::FRIEND_DELETE_TYPE_BOTH
    ): array
    {
        return $this->httpClient->postJson('sns/friend_delete', [
            'From_Account' => $fromAccountId,
            'To_Account' => $toAccountIds,
            'DeleteType' => $deleteType,
        ]);
    }

    /**
     * 删除所有好友.
     */
    public function deleteAll(
        string $fromAccountId,
        string $deleteType = Constants::FRIEND_DELETE_TYPE_SIGNLE
    ): bool
    {
        $r = $this->httpClient->postJson('sns/friend_delete_all', [
            'From_Account' => $fromAccountId,
            'DeleteType' => $deleteType,
        ]);

        return Constants::ACTION_STATUS_OK === $r['ActionStatus'];
    }

    /**
     * 更新好友.
     */
    public function update(
        string $fromAccountId,
        string $toAccountId,
        array  $items
    ): array
    {
        return $this->httpClient->postJson('sns/friend_update', [
            'From_Account' => $fromAccountId,
            'UpdateItem' => [['To_Account' => $toAccountId, 'SnsItem' => (array)$items]],
        ]);
    }

    /**
     * 批量更新好友.
     */
    public function batchUpdate(
        string $fromAccountId,
        array  $items
    ): array
    {
        return $this->httpClient->postJson('sns/friend_update', [
            'From_Account' => $fromAccountId,
            'UpdateItem' => (array)$items,
        ]);
    }

    /**
     * 批量导入好友.
     */
    public function import(
        string $fromAccountId,
        array  $friendItems
    ): array
    {
        return $this->httpClient->postJson('sns/friend_import', [
            'From_Account' => $fromAccountId,
            'AddFriendItem' => (array)$friendItems,
        ]);
    }

    /**
     * 校验好友.
     */
    public function check(
        string $fromAccountId,
        array  $toAccountIds,
        string $checkType = Constants::FRIEND_CHECK_TYPE_BOTH
    ): array
    {
        if (count($toAccountIds) > 1000) {
            throw new \InvalidArgumentException('AccountIds size limit exceeded.', -1);
        }

        return $this->httpClient->postJson('sns/friend_check', [
            'From_Account' => $fromAccountId,
            'To_Account' => $toAccountIds,
            'CheckType' => $checkType,
        ]);
    }

    /**
     * 添加分组，支持批量添加分组.
     */
    public function addGroup(string $fromAccountId, array $groupNames): bool
    {
        $p = [
            'From_Account' => $fromAccountId,
            'GroupName' => $groupNames,
        ];
        $r = $this->httpClient->postJson('sns/group_add', $p);

        return Constants::ACTION_STATUS_OK === $r['ActionStatus'];
    }

    /**
     * 添加分组，支持批量添加分组，并将指定好友加入到新增分组中.
     */
    public function addGroupAndJoin(
        string $fromAccountId,
        array  $groupNames,
        array  $toAccountIds
    ): array
    {
        $p = [
            'From_Account' => $fromAccountId,
            'GroupName' => $groupNames,
            'To_Account' => $toAccountIds,
        ];
        $r = $this->httpClient->postJson('sns/group_add', $p);

        return $r['ResultItem'];
    }

    /**
     * 删除指定分组.
     */
    public function deleteGroup(string $fromAccountId, array $groupNames): bool
    {
        $p = [
            'From_Account' => $fromAccountId,
            'GroupName' => $groupNames,
        ];
        $r = $this->httpClient->postJson('sns/group_delete', $p);

        return Constants::ACTION_STATUS_OK === $r['ActionStatus'];
    }

    public function getGroup(string $fromAccountId, int $lastSequence = 0, array $groupNames = [], bool $needFriend = false): bool
    {
        $p = [
            'From_Account' => $fromAccountId,
            'LastSequence' => $lastSequence,
        ];
        if ($needFriend) {
            $p['Need_Friend_Type_Yes'] = 'Need_Friend_Type_Yes';
        }
        if (!empty($groupNames)) {
            $p['GroupName'] = $groupNames;
        }
        $r = $this->httpClient->postJson('sns/group_get', $p);

        return Constants::ACTION_STATUS_OK === $r['ActionStatus'];
    }
}
