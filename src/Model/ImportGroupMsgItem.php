<?php

namespace QcloudIM\Model;

class ImportGroupMsgItem
{
    /** @var string 消息发送者 */
    public $From_Account;
    /** @var int 发送时间 */
    public $SendTime;
    /** @var int 消息随机数（可选） */
    public $Random;
    /** @var string 消息体 */
    public $MsgBody;

}
