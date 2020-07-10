<?php

namespace QcloudIM\Api;

use QcloudIM\Constants;
use QcloudIM\Model\SendGroupMsgItem;
use QcloudIM\Traits\HttpClientTrait;

/**
 * 群组管理(消息)
 */
class GroupMessage
{
    use HttpClientTrait;

    /**
     * 删除群消息，删除最近1000条消息内某个人发送的消息
     *
     * @param string $accountId
     *
     * @return bool
     */
    public function deleteGroupMsgBySender(string $groupId, string $accountId): bool
    {
        $r = $this->httpClient->postJson('group_open_http_svc/delete_group_msg_by_sender', [
            'GroupId' => $groupId, 'Sender_Account' => $accountId
        ]);
        return $r['ActionStatus'] === Constants::ACTION_STATUS_OK;
    }

    /**
     * 设置成员未读消息计数
     * App 管理员使用该接口设置群组成员未读消息数，不会触发回调、不会下发通知。
     *
     * @param string $groupId
     * @param string $accountId
     * @param int    $unreadMsgNum
     *
     * @return bool
     */
    public function setUnreadMsgNum(string $groupId, string $accountId, int $unreadMsgNum): bool
    {
        $r = $this->httpClient->postJson('group_open_http_svc/set_unread_msg_num', [
            'GroupId' => $groupId, 'Member_Account' => $accountId, 'UnreadMsgNum' => $unreadMsgNum
        ]);
        return $r['ActionStatus'] === Constants::ACTION_STATUS_OK;
    }

    /**
     * 批量禁言和取消禁言
     *
     * @param string $groupId
     * @param array  $membersAccount 需要禁言的用户帐号，最多支持500个帐号
     * @param int    $shutUpTime     需禁言时间，单位为秒，为0时表示取消禁言
     *
     * @return bool
     */
    public function forbidSendMsg(string $groupId, array $membersAccount, int $shutUpTime = 60): bool
    {
        $r = $this->httpClient->postJson('group_open_http_svc/forbid_send_msg', [
            'GroupId' => $groupId, 'Members_Account' => $membersAccount, 'ShutUpTime' => $shutUpTime
        ]);
        return $r['ActionStatus'] === Constants::ACTION_STATUS_OK;
    }

    /**
     * 获取被禁言群成员列表
     *
     * @param string $groupId
     *
     * @return array
     */
    public function getGroupShuttedUin(string $groupId): array
    {
        $r = $this->httpClient->postJson('group_open_http_svc/get_group_shutted_uin', [
            'GroupId' => $groupId,
        ]);
        return $r['ShuttedUinList'];
    }

    /**
     * 撤回群消息
     * 消息撤回之后将无法恢复，请谨慎调用该接口
     *
     * @param string $groupId
     * @param array  $msgSeqArray
     *
     * @return array
     */
    public function recallGroupMsg(string $groupId, array $msgSeqArray): array
    {
        $r = $this->httpClient->postJson('group_open_http_svc/group_msg_recall', [
            'GroupId' => $groupId, 'MsgSeqList' => array_map(function ($v) {
                return ['MsgSeq' => $v];
            }, $msgSeqArray)
        ]);
        return $r['RecallRetList'];
    }

    /**
     * 拉取群历史消息
     * 即时通信 IM 的群消息是按 Seq 排序的，按照 server 收到群消息的顺序分配 Seq，先发的群消息 Seq 小，后发的 Seq 大。
     * 如果用户想拉取一个群的全量消息，首次拉取时不用填拉取 Seq，Server 会自动返回最新的消息，以后拉取时拉取 Seq 填上次返回的最小 Seq 减1。
     * 如果返回消息的 IsPlaceMsg 为1，表示这个 Seq 的消息或者过期、或者存储失败、或者被删除了。
     * sFinished    Integer    是否返回了请求区间的全部消息
     * 当消息长度太长或者区间太大（超过20）导致无法返回全部消息时，值为0
     * 当消息长度太长或者区间太大（超过20）且所有消息都过期时，值为2
     *
     * @param string $groupId
     * @param int    $reqMsgSeq
     * @param int    $reqMsgNumber
     *
     * @return array
     */
    public function getGroupMsg(string $groupId, int $reqMsgSeq, int $reqMsgNumber = 20): array
    {
        $r = $this->httpClient->postJson('group_open_http_svc/group_msg_get_simple', [
            'GroupId' => $groupId, 'ReqMsgSeq' => $reqMsgSeq, 'ReqMsgNumber' => $reqMsgNumber,
        ]);
        return $r;
    }

    /**
     * 在群组中发送普通消息
     *
     * @param string           $groupId
     * @param SendGroupMsgItem $item
     *
     * @return array
     */
    public function sendGroupMsg(string $groupId, SendGroupMsgItem $item): array
    {
        $item->setGroupId($groupId);
        $r = $this->httpClient->postJson('group_open_http_svc/send_group_msg', (array)$item);
        return $r;
    }

    /**
     * 在群组中发送系统通知
     *
     * @param string $groupId
     * @param string $content
     * @param array  $toMembersAccount
     *
     * @return bool
     */
    public function sendGroupSystemNotification(string $groupId, string $content, array $toMembersAccount = []): bool
    {
        $p = ['GroupId' => $groupId, 'Content' => $content,];
        empty($toMembersAccount) or $p['ToMembers_Account'] = $toMembersAccount;
        $r = $this->httpClient->postJson('group_open_http_svc/send_group_system_notification', $p);
        return $r['ActionStatus'] === Constants::ACTION_STATUS_OK;
    }

}
