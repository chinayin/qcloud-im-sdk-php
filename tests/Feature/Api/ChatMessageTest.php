<?php

namespace QcloudIM\Tests\Feature\Api;

use QcloudIM\Api\ChatMessage;
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
        $toAccountId = '';
        $msg = new SendChatMsgItem();
        $r = $this->chatMessage->sendMsg($toAccountId, $msg);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testBatchSendMsg()
    {
        $toAccountIds = [];
        $msg = new SendChatMsgItem();
        $r = $this->chatMessage->batchSendMsg($toAccountIds, $msg);
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
        $toAccountId = '';
        $msg = new SendChatMsgItem();
        $r = $this->chatMessage->import($toAccountId, $msg);
        $this->assertTrue($r);
    }

}
