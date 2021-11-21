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
    /** @var string 消息来源帐号 */
    public $From_Account;
    /** @var array 消息体 */
    public $MsgBody;
    /** @var array 离线推送信息配置 */
    public $OfflinePushInfo;
    /** @var array 消息回调禁止开关，只对单条消息有效，ForbidBeforeSendMsgCallback 表示禁止发消息前回调，ForbidAfterSendMsgCallback 表示禁止发消息后回调 */
    public $ForbidCallbackControl;
    /** @var int 1表示消息仅发送在线成员，默认0表示发送所有成员，AVChatRoom(直播群)不支持该参数 */
    public $OnlineOnlyFlag;
    /** @var array 指定消息不更新最近联系人会话 如果消息中指定 SendMsgControl，设置 NoLastMsg 的情况下，表示不更新最近联系人会话；NoUnread 不计未读，只对单条消息有效。(AVChatRoom 不允许使用)。 */
    public $SendMsgControl;
    /** @var array 发送群@消息 */
    public $GroupAtInfo;
    /** @var string 消息自定义数据（云端保存，会发送到对端，程序卸载重装后还能拉取到） */
    public $CloudCustomData;

    /**
     * SendGroupMsgItem constructor.
     */
    public function __construct(string $GroupId, int $Random = 0)
    {
        $this->GroupId = $GroupId;
        $this->Random = (0 === $Random ? rand(100000, 999999) : $Random);
    }

    public function getGroupId(): string
    {
        return $this->GroupId;
    }

    public function setGroupId(string $GroupId): void
    {
        $this->GroupId = $GroupId;
    }

    public function getRandom(): int
    {
        return $this->Random;
    }

    public function setRandom(int $Random): void
    {
        $this->Random = $Random;
    }

    public function getMsgPriority(): string
    {
        return $this->MsgPriority;
    }

    public function setMsgPriority(string $MsgPriority): void
    {
        $this->MsgPriority = $MsgPriority;
    }

    public function getFromAccount(): string
    {
        return $this->From_Account;
    }

    public function setFromAccount(string $From_Account): void
    {
        $this->From_Account = $From_Account;
    }

    public function getMsgBody(): array
    {
        return $this->MsgBody;
    }

    public function setMsgBody(array $MsgBody): void
    {
        $this->MsgBody = $MsgBody;
    }

    public function getOfflinePushInfo(): array
    {
        return $this->OfflinePushInfo;
    }

    public function setOfflinePushInfo(array $OfflinePushInfo): void
    {
        $this->OfflinePushInfo = $OfflinePushInfo;
    }

    public function getForbidCallbackControl(): array
    {
        return $this->ForbidCallbackControl;
    }

    public function setForbidCallbackControl(array $ForbidCallbackControl): void
    {
        $this->ForbidCallbackControl = $ForbidCallbackControl;
    }

    public function getOnlineOnlyFlag(): int
    {
        return $this->OnlineOnlyFlag;
    }

    public function setOnlineOnlyFlag(int $OnlineOnlyFlag): void
    {
        $this->OnlineOnlyFlag = $OnlineOnlyFlag;
    }

    public function getSendMsgControl(): array
    {
        return $this->SendMsgControl;
    }

    public function setSendMsgControl(array $SendMsgControl): void
    {
        $this->SendMsgControl = $SendMsgControl;
    }

    public function getGroupAtInfo(): array
    {
        return $this->GroupAtInfo;
    }

    public function setGroupAtInfo(array $GroupAtInfo): void
    {
        $this->GroupAtInfo = $GroupAtInfo;
    }

    public function getCloudCustomData(): string
    {
        return $this->CloudCustomData;
    }

    public function setCloudCustomData(string $CloudCustomData): void
    {
        $this->CloudCustomData = $CloudCustomData;
    }
}
