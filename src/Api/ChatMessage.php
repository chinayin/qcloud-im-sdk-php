<?php

namespace QcloudIM\Api;

use QcloudIM\Constants;
use QcloudIM\Model\ImportChatMsgItem;
use QcloudIM\Model\SendChatMsgItem;
use QcloudIM\Traits\HttpClientTrait;

/**
 * 单聊管理
 */
class ChatMessage
{
    use HttpClientTrait;

    /**
     * 发送单聊消息
     *
     * @param string          $fromAccountId
     * @param string          $toAccountId
     * @param SendChatMsgItem $item
     *
     * @return string
     */
    public function sendMsg(string $fromAccountId, string $toAccountId, SendChatMsgItem $item): string
    {
        $p = ['From_Account' => $fromAccountId, 'To_Account' => $toAccountId] + $item->toArray();
        $r = $this->httpClient->postJson('openim/sendmsg', $p);
        return $r['MsgKey'];
    }

    /**
     * 批量发单聊消息
     *
     * @param string          $fromAccountId
     * @param array           $toAccountIds
     * @param SendChatMsgItem $item
     *
     * @return array
     */
    public function batchSendMsg(string $fromAccountId, array $toAccountIds, SendChatMsgItem $item): array
    {
        if (count($toAccountIds) > 500) {
            throw new \InvalidArgumentException('ToAccountIds size limit exceeded.', -1);
        }
        $p = ['From_Account' => $fromAccountId, 'To_Account' => $toAccountIds] + $item->toArray();
        $r = $this->httpClient->postJson('openim/batchsendmsg', $p);
        return $r;
    }

    /**
     * 撤回消息
     *
     * @param string $fromAccountId
     * @param string $toAccountId
     * @param string $msgKey
     *
     * @return bool
     */
    public function recallChatMsg(string $fromAccountId, string $toAccountId, string $msgKey): bool
    {
        $r = $this->httpClient->postJson('openim/admin_msgwithdraw', [
            'From_Account' => $fromAccountId,
            'To_Account' => $toAccountId,
            'MsgKey' => $msgKey,
        ]);
        return $r['ActionStatus'] === Constants::ACTION_STATUS_OK;
    }

    /**
     * 查询单聊消息
     *
     * @param string $fromAccountId
     * @param string $toAccountId
     * @param int    $minTime
     * @param int    $maxTime
     * @param int    $maxCnt
     * @param string $lastMsgKey 上一次拉取到的最后一条消息的 MsgKey，续拉时需要填该字段
     *
     * @return array
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
        $r = $this->httpClient->postJson('openim/admin_getroammsg', $p);
        return $r;
    }

    /**
     * 消息导入
     *
     * @param string            $fromAccountId
     * @param string            $toAccountId
     * @param ImportChatMsgItem $item
     *
     * @return bool
     */
    public function import(string $fromAccountId, string $toAccountId, ImportChatMsgItem $item): bool
    {
        $p = ['From_Account' => $fromAccountId, 'To_Account' => $toAccountId] + $item->toArray();
        $r = $this->httpClient->postJson('openim/importmsg', $p);
        return $r['ActionStatus'] === Constants::ACTION_STATUS_OK;
    }

}
