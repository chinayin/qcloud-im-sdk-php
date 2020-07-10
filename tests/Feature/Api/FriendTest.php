<?php

namespace QcloudIM\Tests\Feature\Api;

use QcloudIM\Model\AddFriendItem;
use QcloudIM\Tests\TestCase;

class FriendTest extends TestCase
{
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
        $item = new AddFriendItem('5678');
        $item->setAddSource('ios');
        $a = $this->friend->add('1234', $item);
        var_dump($a);
    }

}
