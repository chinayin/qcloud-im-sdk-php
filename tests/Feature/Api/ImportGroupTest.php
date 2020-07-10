<?php

namespace QcloudIM\Tests\Feature\Api;

use QcloudIM\Api\ImportGroup;
use QcloudIM\Model\ImportGroupItem;
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
        $groupId = '';
        $messages = [];
        $r = $this->importGroup->importGroupMsg($groupId, $messages);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

}
