<?php

namespace QcloudIM\Tests\Feature\Api;

use QcloudIM\Api\Friend;
use QcloudIM\Constants;
use QcloudIM\Model\AddFriendItem;
use QcloudIM\Model\ImportAddFriendItem;
use QcloudIM\Model\TagValueItem;
use QcloudIM\Tests\TestCase;

class FriendTest extends TestCase
{

    /** @var Friend */
    private $friend;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->friend = $this->app->get('Friend');
    }

    public function testAdd()
    {
        $item = new AddFriendItem('5678', 'ios');
        $r = $this->friend->add('1234', $item);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testBatchAdd()
    {
        $array = [
            new AddFriendItem('5678', 'ios')
        ];
        $r = $this->friend->batchAdd('1234', $array);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testGet()
    {
        $r = $this->friend->get('CUST_63518', 0);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testDelete()
    {
        $r = $this->friend->delete('CUST_63518', ['CUST_72923']);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testDeleteAll()
    {
        $r = $this->friend->deleteAll('CUST_63518', Constants::FRIEND_DELETE_TYPE_BOTH);
        $this->assertTrue($r);
    }

    public function testUpdate()
    {
        $array = [
            new TagValueItem('Tag_SNS_Custom_Identity', '2')
        ];
        $r = $this->friend->update('CUST_1010889', 'CUST_1010847', $array);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testBatchUpdate()
    {
        $array = [
            ['To_Account' => '', 'SnsItem' => ['Tag' => 'tag', 'Value' => 'value']],
        ];
        $r = $this->friend->batchUpdate('1234', $array);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testImport()
    {
        $array = [
            new ImportAddFriendItem('CUST_73133', 'ios', 1571987540),
            new ImportAddFriendItem('CUST_155515', 'ios', 1571987540)
        ];
        $r = $this->friend->import('CUST_63518', $array);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testCheck()
    {
        $r = $this->friend->check('CUST_63518', ['CUST_1010847']);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

}
