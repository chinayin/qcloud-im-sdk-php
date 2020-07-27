<?php

namespace QcloudIM\Tests\Feature\Api;

use QcloudIM\Api\Group;
use QcloudIM\Constants;
use QcloudIM\Model\CreateGroupItem;
use QcloudIM\Model\GroupMemberInfoResponseFilter;
use QcloudIM\Model\GroupResponseFilter;
use QcloudIM\Model\ModifyGroupItem;
use QcloudIM\Model\ModifyGroupMemberInfoItem;
use QcloudIM\Tests\TestCase;

class GroupTest extends TestCase
{
    /**
     * @var Group
     */
    protected $group;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->group = $this->app->get('Group');
    }

    public function testCreate()
    {
        $g = new CreateGroupItem(Constants::GROUP_TYPE_PUBLIC, 'CUST_63518');
        $r = $this->group->create($g);
        $this->assertTrue($r);
    }

    public function testGet()
    {
//        $groupId = '@TGS#2W7TEZSG3';
        $groupId = '@TGS#2J4SZEAEL';
        $filter = new GroupResponseFilter();
        $filter->setGroupBaseInfoFilter([
            "Type",
            "Name",
            "Introduction",
            "Notification"
        ]);
        $r = $this->group->get($groupId, $filter);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testModify()
    {
        $groupId = '@TGS#2W7TEZSG3';
        $item = new ModifyGroupItem();
        $item->setName('修改了群名字_' . date('Ymd'));
        $r = $this->group->modify($groupId, $item);
        $this->assertTrue($r);
    }

    public function testDestroy()
    {
        $groupId = '@TGS#2W7TEZSG3';
        $r = $this->group->destroy($groupId);
        $this->assertTrue($r);
    }

    public function testChangeGroupOwner()
    {
        $groupId = '@TGS#2W7TEZSG3';
        $newOwnerAccountId = 'CUST_63518';
        $r = $this->group->changeGroupOwner($groupId, $newOwnerAccountId);
        $this->assertTrue($r);
    }

    public function testGetRoleInGroup()
    {
        $groupId = '@TGS#2W7TEZSG3';
        $accounts = [];
        $r = $this->group->getRoleInGroup($groupId, $accounts);
        $this->assertNotEmpty($r);
    }

    public function testGetJoinedGroupList()
    {
        $accountId = '';
        $r = $this->group->getJoinedGroupList($accountId);
        $this->assertNotEmpty($r);
    }

    public function testModifyGroupMemberInfo()
    {
        $groupId = '@TGS#2W7TEZSG3';
        $accountId = '';
        $item = new ModifyGroupMemberInfoItem($groupId, $accountId);
        $r = $this->group->modifyGroupMemberInfo($item);
        $this->assertTrue($r);
    }

    public function testAddGroupMember()
    {
        $groupId = '@TGS#2W7TEZSG3';
        $accountIds = [];
//        for ($i = 0; $i < 502; $i++) {
//            $accountIds[] = 'a' . time();
//        }
        $r = $this->group->addGroupMember($groupId, $accountIds);
        $this->assertNotEmpty($r);
    }

    public function testDeleteGroupMember()
    {
        $groupId = '@TGS#1JN6ZNTGQ';
        $accountIds = ['CUST_72923'];
        $reason = '踢人理由';
        $r = $this->group->deleteGroupMember($groupId, $accountIds, $reason);
        $this->assertTrue($r);
    }

    public function testGetGroupMemberInfo()
    {
        $groupId = '@TGS#1JN6ZNTGQ';
        $filter = new GroupMemberInfoResponseFilter();
        $r = $this->group->getGroupMemberInfo($groupId, $filter);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

}
