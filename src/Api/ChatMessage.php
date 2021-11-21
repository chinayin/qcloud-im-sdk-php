<?php

namespace QcloudIM\Api;

use QcloudIM\Constants;
use QcloudIM\Model\SendChatMsgItem;
use QcloudIM\Traits\HttpClientTrait;

/**
 * 单聊管理.
 */
class ChatMessage
{
    use HttpClientTrait;

    /**
     * 发送单聊消息.
     */
    public function sendMsg(string $toAccountId, SendChatMsgItem $item): string
    {
        $p = ['To_Account' => $toAccountId] + (array) $item;
        $r = $this->httpClient->postJson('openim/sendmsg', $p);

        return $r['MsgKey'];
    }

    /**
     * 批量发单聊消息.
     */
    public function batchSendMsg(array $toAccountIds, SendChatMsgItem $item): array
    {
        if (count($toAccountIds) > 500) {
            throw new \InvalidArgumentException('ToAccountIds size limit exceeded.', -1);
        }
        $p = ['To_Account' => $toAccountIds] + (array) $item;

        return $this->httpClient->postJson('openim/sendmsg', (array) $item);
    }

    /**
     * 撤回消息.
     */
    public function recallChatMsg(string $fromAccountId, string $toAccountId, string $msgKey): bool
    {
        $r = $this->httpClient->postJson('openim/admin_msgwithdraw', [
            'From_Account' => $fromAccountId,
            'To_Account' => $toAccountId,
            'MsgKey' => $msgKey,
        ]);

        return Constants::ACTION_STATUS_OK === $r['ActionStatus'];
    }

    /**
     * 查询单聊消息.
     *
     * @param string $lastMsgKey 上一次拉取到的最后一条消息的 MsgKey，续拉时需要填该字段
     */
    public function getChatMsg(
        string $fromAccountId,
        string $toAccountId,
        int $minTime,
        int $maxTime,
        int $maxCnt,
        string $lastMsgKey = ''
    ): array {
        $p = [
            'From_Account' => $fromAccountId,
            'To_Account' => $toAccountId,
            'MinTime' => $minTime,
            'MaxTime' => $maxTime,
            'MaxCnt' => $maxCnt,
        ];
        empty($lastMsgKey) or $p['LastMsgKey'] = $lastMsgKey;

        return $this->httpClient->postJson('openim/admin_getroammsg', $p);
    }

    /**
     * 消息导入.
     */
    public function import(string $toAccountId, SendChatMsgItem $item): bool
    {
        $p = ['To_Account' => $toAccountId] + (array) $item;
        $r = $this->httpClient->postJson('openim/importmsg', $p);

        return Constants::ACTION_STATUS_OK === $r['ActionStatus'];
    }
}
