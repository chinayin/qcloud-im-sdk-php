<?php

namespace QcloudIM\Tests\Feature\Api;

use QcloudIM\Api\GlobalConfig;
use QcloudIM\Tests\TestCase;

class GlobalConfigTest extends TestCase
{
    /**
     * @var GlobalConfig
     */
    protected $globalConfig;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->globalConfig = $this->app->get('GlobalConfig');
    }

    public function testGetIpList()
    {
        $r = $this->globalConfig->getIpList();
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testGetNoSpeaking()
    {
        $accountId = 'CUST_63518';
        $r = $this->globalConfig->getNoSpeaking($accountId);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testSetNoSpeaking()
    {
        $accountId = 'CUST_63518';
        $C2CmsgNospeakingTime = 10;
        $GroupmsgNospeakingTime = 20;
        $r = $this->globalConfig->setNoSpeaking($accountId, $C2CmsgNospeakingTime, $GroupmsgNospeakingTime);
        $this->assertTrue($r);
    }

    public function testGetAppInfo()
    {
        $fields = [
            'GroupNewGroupNum'
        ];
        $r = $this->globalConfig->getAppInfo($fields);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testGetHistory()
    {
        $chatType = 'Group';
        $msgTime = '2020070918';
        $r = $this->globalConfig->getHistory($chatType, $msgTime);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

}
