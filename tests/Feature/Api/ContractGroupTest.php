<?php

namespace QcloudIM\Tests\Feature\Api;

use QcloudIM\Api\RecentContact;
use QcloudIM\Model\UpdateContactGroupItem;
use QcloudIM\Tests\TestCase;

class ContractGroupTest extends TestCase
{
    /**
     * @var RecentContact
     */
    protected $recentContact;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->recentContact = $this->app->get('RecentContact');
    }

    public function testUpdate()
    {
        $item = new UpdateContactGroupItem();
        $item->setFromAccount('USER_1');
        $item->setUpdateType(1);
        $item->setUpdateGroup(
            [
                'UpdateGroupType' => 2,
                "OldGroupName" => "inner",
                'ContactUpdateItem' => [
                    [
                        'ContactOptType' => 1,
                        'ContactItem' => [
                            'Type' => 2,
                            'ToGroupId' => '@TGS#1BJU6YSQT',
                        ],
                    ],
                    [
                        'ContactOptType' => 1,
                        'ContactItem' => [
                            'Type' => 2,
                            'ToGroupId' => '@TGS#1ZOF7YSQD',
                        ],
                    ],
                    [
                        'ContactOptType' => 1,
                        'ContactItem' => [
                            'Type' => 2,
                            'ToGroupId' => '@TGS#17RPAZSQX',
                        ],
                    ],
                ],
            ]
        );

        $r = $this->recentContact->updateContactGroup($item);
        $this->assertTrue($r);
    }
}
