<?php

namespace QcloudIM\Model;

class SendChatMsgItem extends Model
{
    /** @var int 消息随机数，由随机函数产生，用于后台定位问题（必填） */
    public $MsgRandom;
    /** @var string TIM 消息对象类型(必填) */
    public $MsgType;
    /** @var array 消息体(必填) */
    public $MsgBody;
    /** @var array 消息体(必填) */
    public $MsgContent;
    /** @var string 消息来源帐号 */
    public $From_Account;
    /** @var int 消息时间戳，UNIX 时间戳（单位：秒） */
    public $MsgTimeStamp;

    /** @var int 消息离线保存时长（单位：秒），最长为7天（604800秒）
     * 若设置该字段为0，则消息只发在线用户，不保存离线
     * 若设置该字段超过7天（604800秒），仍只保存7天
     * 若不设置该字段，则默认保存7天 */
    public $MsgLifeTime;

    /** @var int
     * 1：把消息同步到 From_Account 在线终端和漫游上；
     * 2：消息不同步至 From_Account；
     * 若不填写默认情况下会将消息存 From_Account 漫游
     */
    public $SyncOtherMachine;

    /** @var array 离线推送信息配置 */
    public $OfflinePushInfo;

    /**
     * SendChatMsgItem constructor.
     */
    public function __construct()
    {
        $this->MsgRandom = rand(100000, 999999);
    }

    public function getMsgRandom(): int
    {
        return $this->MsgRandom;
    }

    public function setMsgRandom(int $MsgRandom): void
    {
        $this->MsgRandom = $MsgRandom;
    }

    public function getMsgType(): string
    {
        return $this->MsgType;
    }

    public function setMsgType(string $MsgType): void
    {
        $this->MsgType = $MsgType;
    }

    public function getMsgBody(): array
    {
        return $this->MsgBody;
    }

    public function setMsgBody(array $MsgBody): void
    {
        $this->MsgBody = $MsgBody;
    }

    public function getMsgContent(): array
    {
        return $this->MsgContent;
    }

    public function setMsgContent(array $MsgContent): void
    {
        $this->MsgContent = $MsgContent;
    }

    public function getFromAccount(): string
    {
        return $this->From_Account;
    }

    public function setFromAccount(string $From_Account): void
    {
        $this->From_Account = $From_Account;
    }

    public function getMsgTimeStamp(): int
    {
        return $this->MsgTimeStamp;
    }

    public function setMsgTimeStamp(int $MsgTimeStamp): void
    {
        $this->MsgTimeStamp = $MsgTimeStamp;
    }

    public function getMsgLifeTime(): int
    {
        return $this->MsgLifeTime;
    }

    public function setMsgLifeTime(int $MsgLifeTime): void
    {
        $this->MsgLifeTime = $MsgLifeTime;
    }

    public function getSyncOtherMachine(): int
    {
        return $this->SyncOtherMachine;
    }

    public function setSyncOtherMachine(int $SyncOtherMachine): void
    {
        $this->SyncOtherMachine = $SyncOtherMachine;
    }

    public function getOfflinePushInfo(): array
    {
        return $this->OfflinePushInfo;
    }

    public function setOfflinePushInfo(array $OfflinePushInfo): void
    {
        $this->OfflinePushInfo = $OfflinePushInfo;
    }
}
