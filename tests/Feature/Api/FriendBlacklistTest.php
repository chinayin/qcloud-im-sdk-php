<?php

namespace QcloudIM\Tests\Feature\Api;

use QcloudIM\Api\FriendBlacklist;
use QcloudIM\Tests\TestCase;

class FriendBlacklistTest extends TestCase
{

    /** @var FriendBlacklist */
    private $friendBlacklist;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->friendBlacklist = $this->app->get('FriendBlacklist');
    }

    public function testAdd()
    {
        $r = $this->friendBlacklist->add('1234', ['444', '555']);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testDelete()
    {
        $r = $this->friendBlacklist->delete('CUST_63518', ['CUST_72923']);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testGet()
    {
        $startIndex = 0;
        $lastSequence = 0;
        $maxLimited = 50;
        $r = $this->friendBlacklist->get('CUST_63518', $startIndex, $lastSequence, $maxLimited);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testCheck()
    {
        $r = $this->friendBlacklist->check('CUST_63518', ['CUST_1010847']);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

}
