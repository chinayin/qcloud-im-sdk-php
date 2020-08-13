<?php

namespace QcloudIM\Model;

class SendGroupMsgItem
{
    /** @var string 群ID（必填） */
    public $GroupId;
    /** @var int 无符号32位整数。如果5分钟内两条消息的随机值相同，后一条消息将被当做重复消息而丢弃（必填） */
    public $Random;
    /** @var string 消息优先级 */
    public $MsgPriority;
    /** @var string  消息来源帐号 */
    public $From_Account;
    /** @var array 消息体 */
    public $MsgBody;
    /** @var array 离线推送信息配置 */
    public $OfflinePushInfo;
    /** @var array 消息回调禁止开关，只对单条消息有效，ForbidBeforeSendMsgCallback 表示禁止发消息前回调，ForbidAfterSendMsgCallback 表示禁止发消息后回调 */
    public $ForbidCallbackControl;
    /** @var int 1表示消息仅发送在线成员，默认0表示发送所有成员，AVChatRoom(直播群)不支持该参数 */
    public $OnlineOnlyFlag;

    /**
     * SendGroupMsgItem constructor.
     *
     * @param string $GroupId
     * @param int    $Random
     */
    public function __construct(string $GroupId, int $Random = 0)
    {
        $this->GroupId = $GroupId;
        $this->Random = ($Random === 0 ? rand(100000, 999999) : $Random);
    }

    /**
     * @return string
     */
    public function getGroupId(): string
    {
        return $this->GroupId;
    }

    /**
     * @param string $GroupId
     */
    public function setGroupId(string $GroupId): void
    {
        $this->GroupId = $GroupId;
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
    public function getMsgPriority(): string
    {
        return $this->MsgPriority;
    }

    /**
     * @param string $MsgPriority
     */
    public function setMsgPriority(string $MsgPriority): void
    {
        $this->MsgPriority = $MsgPriority;
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
     * @return array
     */
    public function getOfflinePushInfo(): array
    {
        return $this->OfflinePushInfo;
    }

    /**
     * @param array $OfflinePushInfo
     */
    public function setOfflinePushInfo(array $OfflinePushInfo): void
    {
        $this->OfflinePushInfo = $OfflinePushInfo;
    }

    /**
     * @return array
     */
    public function getForbidCallbackControl(): array
    {
        return $this->ForbidCallbackControl;
    }

    /**
     * @param array $ForbidCallbackControl
     */
    public function setForbidCallbackControl(array $ForbidCallbackControl): void
    {
        $this->ForbidCallbackControl = $ForbidCallbackControl;
    }

    /**
     * @return int
     */
    public function getOnlineOnlyFlag(): int
    {
        return $this->OnlineOnlyFlag;
    }

    /**
     * @param int $OnlineOnlyFlag
     */
    public function setOnlineOnlyFlag(int $OnlineOnlyFlag): void
    {
        $this->OnlineOnlyFlag = $OnlineOnlyFlag;
    }

}
