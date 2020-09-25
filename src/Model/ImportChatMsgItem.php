<?php

namespace QcloudIM\Model;

class ImportChatMsgItem extends Model
{
    /** @var string  消息来源帐号 */
    public $From_Account;
    /** @var string  消息目标帐号 */
    public $To_Account;

    /** @var int 消息随机数，由随机函数产生，用于后台定位问题（必填） */
    public $MsgRandom;
    /** @var array 消息体(必填) */
    public $MsgBody;
    /** @var int 消息时间戳，UNIX 时间戳（单位：秒） */
    public $MsgTimeStamp;

    /** @var int 该字段只能填1或2，其他值是非法值
     * 1表示实时消息导入，消息加入未读计数
     * 2表示历史消息导入，消息不计入未读 */
    public $SyncFromOldSystem;

    /**
     * SendChatMsgItem constructor.
     */
    public function __construct()
    {
        $this->MsgRandom = rand(100000, 999999);
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
     * @return string
     */
    public function getToAccount(): string
    {
        return $this->To_Account;
    }

    /**
     * @param string $To_Account
     */
    public function setToAccount(string $To_Account): void
    {
        $this->To_Account = $To_Account;
    }

    /**
     * @return int
     */
    public function getMsgRandom(): int
    {
        return $this->MsgRandom;
    }

    /**
     * @param int $MsgRandom
     */
    public function setMsgRandom(int $MsgRandom): void
    {
        $this->MsgRandom = $MsgRandom;
    }

    /**
     * @return array
     */
    public function getMsgBody(): array
    {
        return $this->MsgBody;
    }

    /**
     * @param array $MsgBody
     */
    public function setMsgBody(array $MsgBody): void
    {
        $this->MsgBody = $MsgBody;
    }

    /**
     * @return int
     */
    public function getMsgTimeStamp(): int
    {
        return $this->MsgTimeStamp;
    }

    /**
     * @param int $MsgTimeStamp
     */
    public function setMsgTimeStamp(int $MsgTimeStamp): void
    {
        $this->MsgTimeStamp = $MsgTimeStamp;
    }

    /**
     * @return int
     */
    public function getSyncFromOldSystem(): int
    {
        return $this->SyncFromOldSystem;
    }

    /**
     * @param int $SyncFromOldSystem
     */
    public function setSyncFromOldSystem(int $SyncFromOldSystem): void
    {
        $this->SyncFromOldSystem = $SyncFromOldSystem;
    }

}
