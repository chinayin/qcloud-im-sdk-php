<?php

namespace QcloudIM\Tests\Feature\Cache;

use QcloudIM\Cache\Token;
use QcloudIM\Tests\TestCase;

class TokenTest extends TestCase
{
    /**
     * @var Token
     */
    protected $token;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->token = new Token();
        $this->token->setSdkAppId('1111');
        $this->token->setSecret('2222');
        $this->token->setIdentifier('3333');
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function testGetCacheKey()
    {
        $this->assertEquals(md5('qcloudim.token.' . md5('1111__2222__3333')),
            $this->callMethod($this->token, 'getCacheKey'));
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function testGetFromServer()
    {
        $a = $this->callMethod($this->token, 'getFromServer');
        var_dump($a);
        $this->assertNotEmpty($a);
    }
}
