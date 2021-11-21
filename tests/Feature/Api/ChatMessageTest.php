<?php

namespace QcloudIM\Tests\Feature\Api;

use QcloudIM\Api\ChatMessage;
use QcloudIM\Model\ImportChatMsgItem;
use QcloudIM\Model\SendChatMsgItem;
use QcloudIM\Tests\TestCase;

class ChatMessageTest extends TestCase
{
    /**
     * @var ChatMessage
     */
    protected $chatMessage;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->chatMessage = $this->app->get('ChatMessage');
    }

    public function testSendMsg()
    {
        $fromAccountId = '';
        $toAccountId = '';
        $msg = new SendChatMsgItem();
        $r = $this->chatMessage->sendMsg($fromAccountId, $toAccountId, $msg);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testBatchSendMsg()
    {
        $fromAccountId = '';
        $toAccountIds = [];
        $msg = new SendChatMsgItem();
        $r = $this->chatMessage->batchSendMsg($fromAccountId, $toAccountIds, $msg);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testRecallChatMsg()
    {
        $fromAccountId = '';
        $toAccountId = '';
        $msgKey = '';
        $r = $this->chatMessage->recallChatMsg($fromAccountId, $toAccountId, $msgKey);
        $this->assertTrue($r);
    }

    public function testGetChatMsg()
    {
        $fromAccountId = '';
        $toAccountId = '';
        $minTime = 1;
        $maxTime = 2;
        $maxCnt = 1111;
        $lastMsgKey = '';
        $r = $this->chatMessage->getChatMsg($fromAccountId,
            $toAccountId,
            $minTime,
            $maxTime,
            $maxCnt,
            $lastMsgKey);
        $this->assertTrue($r);
    }

    public function testImport()
    {
        $msg = new ImportChatMsgItem();
        $msg->setMsgTimeStamp(1601012393);
        $msg->setSyncFromOldSystem(2);
        $msg->setMsgBody(json_decode('[{"MsgType":"TIMTextElem","MsgContent":{"Text":"导入消息了吗2?"}}]', true));
        $r = $this->chatMessage->import('CUST_63518', 'CUST_1000396', $msg);
        $this->assertTrue($r);
    }

}
