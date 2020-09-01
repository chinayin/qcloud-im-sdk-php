<?php

namespace QcloudIM\Tests\Model;

use QcloudIM\Model\SendChatMsgItem;
use QcloudIM\Tests\TestCase;

class ModelTest extends TestCase
{

    public function testGenerateBody()
    {
        $model = new SendChatMsgItem();
        $model->setFromAccount('aaaa');
        $model->setSyncOtherMachine(1);
        var_dump($model);
        $a = $model->generateBody();
        var_dump($a);
        $this->assertTrue(true);
    }

}
