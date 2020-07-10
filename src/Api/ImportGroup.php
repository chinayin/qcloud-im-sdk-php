<?php

namespace QcloudIM\Api;

use QcloudIM\Model\ImportGroupItem;
use QcloudIM\Traits\HttpClientTrait;

/**
 * 群组管理(导入相关)
 */
class ImportGroup
{
    use HttpClientTrait;

    /**
     * 导入群组
     *
     * @param ImportGroupItem $item
     *
     * @return string
     */
    public function import(ImportGroupItem $item): string
    {
        $r = $this->httpClient->postJson('group_open_http_svc/import_group',
            (array)$item
        );
        return $r['GroupId'] ?? '';
    }

    /**
     * 导入群成员
     * 一次请求最多支持添加500个成员
     * 请保证导入成员的入群时间大于群的创建时间并小于当前时间，否则该成员会导入失败。
     *
     * @param string $groupId
     * @param array  $members
     *
     * @return array
     */
    public function importGroupMember(string $groupId, array $members): array
    {
        $r = $this->httpClient->postJson('group_open_http_svc/import_group_member', [
            'GroupId' => $groupId,
            'MemberList' => $members,
        ]);
        return $r['MemberList'];
    }

    /**
     * 群消息导入
     * 一次最多导入20条
     * 使用本接口导入消息后所有成员的未读计数都会变成0，如果要保留未读计数，请在导入所有消息后再导入群成员或者设置成员未读计数。
     * 导入的消息必须按照时间戳递增的顺序导入，且导入消息的时间戳必须小于当前时间，并大于建群时间和当前群内最新一条消息的时间，否则会失败
     * 单条消息导入结果
     * 0表示单条消息成功
     * 10004表示单条消息发送时间无效
     * 80001表示单条消息包含脏字，拒绝存储此消息
     * 80002表示为消息内容过长，目前支持8000字节的消息，请调整消息长度
     *
     * @param string $groupId
     * @param array  $messages
     *
     * @return array
     */
    public function importGroupMsg(string $groupId, array $messages): array
    {
        $r = $this->httpClient->postJson('group_open_http_svc/import_group_msg', [
            'GroupId' => $groupId,
            'MsgList' => $messages,
        ]);
        return $r['ImportMsgResult'];
    }

}
