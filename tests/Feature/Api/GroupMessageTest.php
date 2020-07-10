<?php

namespace QcloudIM\Tests\Feature\Api;

use QcloudIM\Api\GroupMessage;
use QcloudIM\Model\SendGroupMsgItem;
use QcloudIM\Tests\TestCase;

class GroupMessageTest extends TestCase
{
    /**
     * @var GroupMessage
     */
    protected $groupMessage;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->groupMessage = $this->app->get('GroupMessage');
    }

    public function testDeleteGroupMsgBySender()
    {
        $groupId = '@TGS#2W7TEZSG3';
        $accountId = '';
        $r = $this->groupMessage->deleteGroupMsgBySender($groupId, $accountId);
        $this->assertTrue($r);
    }

    public function testSetUnreadMsgNum()
    {
        $groupId = '@TGS#2W7TEZSG3';
        $accountId = '';
        $unreadMsgNum = 1;
        $r = $this->groupMessage->setUnreadMsgNum($groupId, $accountId, $unreadMsgNum);
        $this->assertTrue($r);
    }

    public function testForbidSendMsg()
    {
        $groupId = '@TGS#2W7TEZSG3';
        $membersAccount = [];
        $shutUpTime = 60;
        $r = $this->groupMessage->forbidSendMsg($groupId, $membersAccount, $shutUpTime);
        $this->assertTrue($r);
    }

    public function testGetGroupShuttedUin()
    {
        $groupId = '@TGS#2W7TEZSG3';
        $r = $this->groupMessage->getGroupShuttedUin($groupId);
        var_dump($r);
        $this->assertNotFalse($r);
    }

    public function testRecallGroupMsg()
    {
        $groupId = '@TGS#2W7TEZSG3';
        $msgSeqArray = [];
        $r = $this->groupMessage->recallGroupMsg($groupId, $msgSeqArray);
        $this->assertNotEmpty($r);
    }

    public function testGetGroupMsg()
    {
        $groupId = '@TGS#2W7TEZSG3';
        $reqMsgSeq = 0;
        $r = $this->groupMessage->getGroupMsg($groupId, $reqMsgSeq);
        $this->assertNotEmpty($r);
    }

    public function testSendGroupMsg()
    {
        $groupId = '@TGS#2W7TEZSG3';
        $msg = new SendGroupMsgItem($groupId);
        $r = $this->groupMessage->sendGroupMsg($groupId, $msg);
        $this->assertNotEmpty($r);
    }

    public function testSendGroupSystemNotification()
    {
        $groupId = '@TGS#2W7TEZSG3';
        $content = '测试一条系统消息吧';
        $toMembersAccount = [];
        $r = $this->groupMessage->sendGroupSystemNotification($groupId, $content, $toMembersAccount);
        $this->assertTrue($r);
    }

}
