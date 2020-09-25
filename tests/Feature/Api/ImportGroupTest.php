<?php

namespace QcloudIM\Tests\Feature\Api;

use GrpcUim\Model\TextMessage;
use QcloudIM\Api\ImportGroup;
use QcloudIM\Model\ImportGroupItem;
use QcloudIM\Model\ImportGroupMsgItem;
use QcloudIM\Tests\TestCase;

class ImportGroupTest extends TestCase
{
    /**
     * @var ImportGroup
     */
    protected $importGroup;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->importGroup = $this->app->get('ImportGroup');
    }

    public function testImport()
    {
        $g = new ImportGroupItem('');
        $r = $this->importGroup->import($g);
        $this->assertNotEmpty($r);
    }

    public function testImportGroupMember()
    {
        $groupId = '';
        $members = [];
        $r = $this->importGroup->importGroupMember($groupId, $members);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testImportGroupMsg()
    {
        $groupId = '@TGS#2YEMI7WGJ';

        $msg = new ImportGroupMsgItem();
        $msg->setFromAccount('CUST_63518');
        $msg->setSendTime(1601028305);
        $msg->setMsgBody(json_decode('[{"MsgType":"TIMTextElem","MsgContent":{"Text":"导入消息了吗222?"}}]', true));
        $messages = [
            $msg
        ];
        $r = $this->importGroup->importGroupMsg($groupId, $messages);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

}
