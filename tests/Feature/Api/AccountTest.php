<?php

namespace QcloudIM\Tests\Feature\Api;

use Mockery\MockInterface;
use QcloudIM\Api\Account;
use QcloudIM\Http\HttpClientInterface;
use QcloudIM\Tests\TestCase;

class AccountTest extends TestCase
{
    /**
     * @var MockInterface
     */
    protected $httpClient;

    /**
     * @var Account
     */
    protected $account;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->httpClient = \Mockery::mock(HttpClientInterface::class);
        $this->account = $this->app->get('Account');
//        $this->account = new Account();
    }

    public function testDelete()
    {
        $r = $this->account->delete(['abcd']);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testCheck()
    {
        $r = $this->account->check('CUST_1010847');
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testBatchCheck()
    {
        $r = $this->account->batchCheck(['CUST_63518', 'abcd']);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testKick()
    {
        $r = $this->account->kick('CUST_63518');
        var_dump($r);
        $this->assertTrue($r);
    }

    public function testQueryState()
    {
        $r = $this->account->queryState('CUST_63518', true);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testBatchQueryState()
    {
        $r = $this->account->batchQueryState(['CUST_63518', 'CUST_1010570', 'aaaa'], true);
        var_dump($r);
        $this->assertNotEmpty($r['QueryResult']);
    }

    public function testImport()
    {
        $array = [
            [
                'CUST_63518', '小浣熊',''
            ]
        ];
        foreach ($array as $v) {
            $a = $this->account->import($v[0], $v[1], $v[2]);
            var_dump($a);
        }
        $this->assertTrue(true);
    }

}
