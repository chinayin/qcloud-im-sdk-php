<?php

namespace QcloudIM\Tests\Feature;

use QcloudIM\Tests\TestCase;

class AppTest extends TestCase
{

    /**
     * @param $expected
     * @param $id
     *
     * @throws \Exception
     * @dataProvider getProvider
     */
    public function testGet($expected, $id)
    {
        $this->assertInstanceOf($expected, $this->app->get($id));
    }

    /**
     * @return array
     */
    public function getProvider()
    {
        return [
            [\QcloudIM\Api\Account::class, 'Account'],
            [\QcloudIM\Api\Profile::class, 'Profile'],
            [\QcloudIM\Api\Friend::class, 'Friend'],
            [\QcloudIM\Api\Group::class, 'Group'],
            [\QcloudIM\Api\GroupMessage::class, 'GroupMessage'],
            [\QcloudIM\Api\ChatMessage::class, 'ChatMessage'],
            [\QcloudIM\Api\ImportGroup::class, 'ImportGroup'],
            [\QcloudIM\Api\GlobalConfig::class, 'GlobalConfig'],
        ];
    }
}
