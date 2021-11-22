<?php

namespace QcloudIM\Api;

use QcloudIM\Constants;
use QcloudIM\Model\ImportChatMsgItem;
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
    public function sendMsg(string $fromAccountId, string $toAccountId, SendChatMsgItem $item): string
    {
        $p = ['From_Account' => $fromAccountId, 'To_Account' => $toAccountId] + $item->toArray();
        $r = $this->httpClient->postJson('openim/sendmsg', $p);

        return $r['MsgKey'];
    }

    /**
     * 批量发单聊消息.
     */
    public function batchSendMsg(string $fromAccountId, array $toAccountIds, SendChatMsgItem $item): array
    {
        if (count($toAccountIds) > 500) {
            throw new \InvalidArgumentException('ToAccountIds size limit exceeded.', -1);
        }
        $p = ['From_Account' => $fromAccountId, 'To_Account' => $toAccountIds] + $item->toArray();

        return $this->httpClient->postJson('openim/batchsendmsg', $p);
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
        if (!empty($lastMsgKey)) {
            $p['LastMsgKey'] = $lastMsgKey;
        }

        return $this->httpClient->postJson('openim/admin_getroammsg', $p);
    }

    /**
     * 消息导入.
     */
    public function import(string $fromAccountId, string $toAccountId, ImportChatMsgItem $item): bool
    {
        $p = ['From_Account' => $fromAccountId, 'To_Account' => $toAccountId] + $item->toArray();
        $r = $this->httpClient->postJson('openim/importmsg', $p);

        return Constants::ACTION_STATUS_OK === $r['ActionStatus'];
    }
}
