<?php

namespace QcloudIM\Tests\Feature\Crypt;

use QcloudIM\Crypt\TLSSigAPIv2;
use QcloudIM\Tests\TestCase;

class CryptTest extends TestCase
{

    private $crypt;

    protected function setUp(): void
    {
        parent::setUp();
        $sdkappid = '1111';
        $secret = '2222';
        $this->crypt = new TLSSigAPIv2($sdkappid, $secret);
    }

    /**
     * @throws \Exception
     */
    public function testGenSig()
    {
        $userid = 'abcd';
        $a = $this->crypt->genSig($userid);
        var_dump($a);
        $init_time = $expire_time = $error_msg = '';
        $success = $this->crypt->verifySig($a, $userid, $init_time, $expire_time, $error_msg);
        var_dump([
            'success' => $success, 'init_time' => $init_time, 'expire_time' => $expire_time, 'error_msg' => $error_msg
        ]);
        $this->assertTrue($success);
    }

}
