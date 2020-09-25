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
    /** @var string 消息体 */
    public $MsgBody;

    /**
     * SendChatMsgItem constructor.
     */
    public function __construct()
    {
        $this->Random = rand(100000, 999999);
    }

    /**
     * @return string
     */
    public function getFromAccount(): string
    {
        return $this->From_Account;
    }

    /**
     * @param string $From_Account
     */
    public function setFromAccount(string $From_Account): void
    {
        $this->From_Account = $From_Account;
    }

    /**
     * @return int
     */
    public function getSendTime(): int
    {
        return $this->SendTime;
    }

    /**
     * @param int $SendTime
     */
    public function setSendTime(int $SendTime): void
    {
        $this->SendTime = $SendTime;
    }

    /**
     * @return int
     */
    public function getRandom(): int
    {
        return $this->Random;
    }

    /**
     * @param int $Random
     */
    public function setRandom(int $Random): void
    {
        $this->Random = $Random;
    }

    /**
     * @return string
     */
    public function getMsgBody(): string
    {
        return $this->MsgBody;
    }

    /**
     * @param string $MsgBody
     */
    public function setMsgBody(string $MsgBody): void
    {
        $this->MsgBody = $MsgBody;
    }

}
