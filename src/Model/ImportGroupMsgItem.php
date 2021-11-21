<?php

namespace QcloudIM\Model;

class ImportGroupMsgItem extends Model
{
    /** @var string 消息发送者 */
    public $From_Account;
    /** @var int 发送时间 */
    public $SendTime;
    /** @var int 消息随机数（可选） */
    public $Random;
    /** @var array 消息体 */
    public $MsgBody;

    /**
     * SendChatMsgItem constructor.
     */
    public function __construct()
    {
        $this->Random = rand(100000, 999999);
    }

    public function getFromAccount(): string
    {
        return $this->From_Account;
    }

    public function setFromAccount(string $From_Account): void
    {
        $this->From_Account = $From_Account;
    }

    public function getSendTime(): int
    {
        return $this->SendTime;
    }

    public function setSendTime(int $SendTime): void
    {
        $this->SendTime = $SendTime;
    }

    public function getRandom(): int
    {
        return $this->Random;
    }

    public function setRandom(int $Random): void
    {
        $this->Random = $Random;
    }

    public function getMsgBody(): array
    {
        return $this->MsgBody;
    }

    public function setMsgBody(array $MsgBody): void
    {
        $this->MsgBody = $MsgBody;
    }
}
