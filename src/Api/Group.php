<?php

namespace QcloudIM\Api;

use QcloudIM\Constants;
use QcloudIM\Model\CreateGroupItem;
use QcloudIM\Model\GroupMemberInfoResponseFilter;
use QcloudIM\Model\GroupResponseFilter;
use QcloudIM\Model\ModifyGroupItem;
use QcloudIM\Model\ModifyGroupMemberInfoItem;
use QcloudIM\Traits\HttpClientTrait;

/**
 * 群组管理.
 */
class Group
{
    use HttpClientTrait;

    /**
     * 创建群组.
     */
    public function create(CreateGroupItem $item): string
    {
        $r = $this->httpClient->postJson(
            'group_open_http_svc/create_group',
            $item->toArray()
        );

        return $r['GroupId'] ?? '';
    }

    /**
     * 获取群组资料.
     */
    public function get(string $groupId, GroupResponseFilter $filter = null): array
    {
        $args = [
            'GroupIdList' => [$groupId],
        ];
        null !== $filter and $args['ResponseFilter'] = $filter->toArray();
        $r = $this->httpClient->postJson('group_open_http_svc/get_group_info', $args);
        $r = $r['GroupInfo'][0];
        if (0 !== $r['ErrorCode']) {
            throw new \InvalidArgumentException($r['ErrorInfo'], $r['ErrorCode']);
        }

        return $r;
    }

    /**
     * 批量获取群组资料.
     */
    public function batchGet(array $groupIds, GroupResponseFilter $filter = null): array
    {
        $args = [
            'GroupIdList' => $groupIds,
        ];
        null !== $filter and $args['ResponseFilter'] = $filter->toArray();
        $r = $this->httpClient->postJson('group_open_http_svc/get_group_info', $args);

        return $r['GroupInfo'];
    }

    /**
     * 修改群基本信息.
     */
    public function modify(string $groupId, ModifyGroupItem $item): bool
    {
        $item->setGroupId($groupId);
        $r = $this->httpClient->postJson('group_open_http_svc/modify_group_base_info', $item->toArray());

        return Constants::ACTION_STATUS_OK === $r['ActionStatus'];
    }

    /**
     * 解散群组.
     */
    public function destroy(string $groupId): bool
    {
        $r = $this->httpClient->postJson('group_open_http_svc/destroy_group', ['GroupId' => $groupId]);

        return Constants::ACTION_STATUS_OK === $r['ActionStatus'];
    }

    /**
     * 更换群主 (转移群组给其他人，转移的新群主必须是群成员)
     * AVChatRoom（直播群）不支持转让群主，对该类型的群组进行操作时会返回10007错误.
     */
    public function changeGroupOwner(string $groupId, string $newOwnerAccountId): bool
    {
        $r = $this->httpClient->postJson('group_open_http_svc/change_group_owner', [
            'GroupId' => $groupId, 'NewOwner_Account' => $newOwnerAccountId,
        ]);

        return Constants::ACTION_STATUS_OK === $r['ActionStatus'];
    }

    /**
     * 查询用户在群组中的身份
     * 拉取到的成员角色，包括：Owner(群主)，Admin(群管理员)，Member(普通群成员），NotMember(非群成员).
     *
     * @param array $accountIds 表示需要查询的用户帐号，最多支持500个帐号
     */
    public function getRoleInGroup(string $groupId, array $accountIds): array
    {
        if (count($accountIds) > 500) {
            throw new \InvalidArgumentException('AccountIds size limit exceeded.', -1);
        }
        $r = $this->httpClient->postJson('group_open_http_svc/get_role_in_group', [
            'GroupId' => $groupId, 'User_Account' => $accountIds,
        ]);

        return $r['UserIdList'];
    }

    /**
     * 获取用户所加入的群组.
     */
    public function getJoinedGroupList(string $accountId): array
    {
        $p = [
            'Member_Account' => $accountId,
        ];

        return $this->httpClient->postJson('group_open_http_svc/get_joined_group_list', $p);
    }

    /**
     * 获取用户所加入的群组(分页).
     */
    public function getJoinedGroupListByPage(string $accountId, int $offset, int $limit = 20): array
    {
        $p = [
            'Member_Account' => $accountId,
            'Offset' => $offset,
            'Limit' => $limit,
        ];

        return $this->httpClient->postJson('group_open_http_svc/get_joined_group_list', $p);
    }

    /**
     * 修改群成员资料.
     */
    public function modifyGroupMemberInfo(ModifyGroupMemberInfoItem $item): bool
    {
        $r = $this->httpClient->postJson('group_open_http_svc/modify_group_member_info', $item->toArray());

        return Constants::ACTION_STATUS_OK === $r['ActionStatus'];
    }

    /**
     * 增加群成员.
     */
    public function addGroupMember(string $groupId, array $accountIds, bool $silence = true): array
    {
        $r = $this->httpClient->postJson('group_open_http_svc/add_group_member', [
            'GroupId' => $groupId,
            'MemberList' => array_map(function ($v) {
                return ['Member_Account' => $v];
            }, $accountIds),
            'Silence' => $silence ? 1 : 0,
        ]);

        return $r['MemberList'];
    }

    /**
     * 删除群成员
     * 传入数组成员，如果在群里都不存在会返回memberlist is empty的错误.
     */
    public function deleteGroupMember(
        string $groupId,
        array $accountIds,
        string $reason = '',
        bool $silence = false
    ): bool {
        if (count($accountIds) > 500) {
            throw new \InvalidArgumentException('AccountIds size limit exceeded.', -1);
        }
        $p = [
            'GroupId' => $groupId,
            'MemberToDel_Account' => $accountIds,
            'Silence' => $silence ? 1 : 0,
        ];
        empty($reason) or $p['Reason'] = $reason;
        $r = $this->httpClient->postJson('group_open_http_svc/delete_group_member', $p);

        return Constants::ACTION_STATUS_OK === $r['ActionStatus'];
    }

    /**
     * 获取群成员详细资料.
     */
    public function getGroupMemberInfo(string $groupId, GroupMemberInfoResponseFilter $filter = null): array
    {
        $p = ['GroupId' => $groupId];
        if (null !== $filter) {
            $p += $filter->toArray();
        }

        return $this->httpClient->postJson('group_open_http_svc/get_group_member_info', $p);
    }

    /**
     * 获取群成员详细资料(分页).
     */
    public function getGroupMemberInfoByPage(
        string $groupId,
        int $offset,
        int $limit = 100,
        GroupMemberInfoResponseFilter $filter = null
    ): array {
        $p = ['GroupId' => $groupId, 'Offset' => $offset, 'Limit' => $limit];
        if (null !== $filter) {
            $p += $filter->toArray();
        }

        return $this->httpClient->postJson('group_open_http_svc/get_group_member_info', $p);
    }

    /**
     * 获取直播群在线人数.
     */
    public function getOnlineMemberNum(string $groupId): int
    {
        $r = $this->httpClient->postJson('group_open_http_svc/get_online_member_num', [
            'GroupId' => $groupId,
        ]);

        return $r['OnlineMemberNum'];
    }
}
