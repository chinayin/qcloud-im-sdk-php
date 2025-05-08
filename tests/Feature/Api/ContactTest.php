<?php

namespace QcloudIM\Tests\Feature\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use QcloudIM\Api\RecentContact;
use QcloudIM\Model\ContactItem;
use QcloudIM\Model\ContactUpdateItem;
use QcloudIM\Model\CreateContactGroupItem;
use QcloudIM\Model\GetContactGroupItem;
use QcloudIM\Model\GetContactListItem;
use QcloudIM\Model\GroupContactItem;
use QcloudIM\Model\Model;
use QcloudIM\Model\UpdateContactGroupItem;
use QcloudIM\Model\UpdateGroup;

class ContactTest extends TestCase
{
    const TopFlag_YES = 1;
    const TopFlag_NO = 0;
    const User_test_1 = 5158;
    const User_test_2 = 6116;
    const User_test = 6184;
    const INNER_GROUP_NAME = 'inner';
    const YX_INNER_GROUP_NAME = 'yx_inner_test';
    const UpdateGroupType_Name = 1;
    const UpdateGroupType_Item = 2;
    const ContactOptType_Add = 1;
    const ContactOptType_Del = 2;

    /**
     * @var RecentContact
     */
    protected $recentContact;

    public function testDemo()
    {
        // 单个用户的会话
        $chatArr = [];
        $userId = self::User_test;

        $startIndex = 0;
        $timeStamp = 0;
        $topStartIndex = 0;
        $topTimeStamp = 0;
        echo "开始 遍历普通会话" . $startIndex . "\n";
        $isFinish = false;

        while (!$isFinish) {
            echo "开始 " . $startIndex . "\n";

            $res = $this->getContractList($userId, $timeStamp, $startIndex, $topTimeStamp, $topStartIndex);
            $isFinish = $this->parseToArr($res, $chatArr);
            if ($isFinish) {
                break;
            }

            sleep(1);
            //续拉参数
            $startIndex = $res['StartIndex'];
            $timeStamp = $res['TimeStamp'];
            $topStartIndex = $res['TopStartIndex'];
            $topTimeStamp = $res['TopTimeStamp'];
            echo "结束 ------- " . "\n";
        }

        $hasContact = $this->getContactGroup($userId, self::YX_INNER_GROUP_NAME);
        if ($hasContact) {
            $item = new UpdateContactGroupItem('USER_' . $userId);

            $updateGroup = new UpdateGroup(self::YX_INNER_GROUP_NAME);
            foreach ($chatArr as $chatId) {
                $Type = strpos($chatId, '@') === 0 ? ContactItem::TYPE_GROUP : ContactItem::TYPE_C2C;

                if ($Type == ContactItem::TYPE_C2C) {
                    $contactItem = new ContactItem($Type, $chatId);
                } else {
                    $contactItem = new ContactItem($Type, null, $chatId);
                }

                $contactUpdateItem = new ContactUpdateItem(ContactUpdateItem::ContactOptType_Add, $contactItem);
                $updateGroup->addGroupContactItem($contactUpdateItem);
            }

            $item->setUpdateGroup($updateGroup);

            $uptRes = $this->sendRequest('/v4/recentcontact/update_contact_group', $item);
            echo "更新分组 ------- " . "\n";
            var_dump($uptRes);
        }
    }

    public function testDelGroupFromContact()
    {
        $item = new UpdateContactGroupItem('USER_' . self::User_test);
        $chatArr = [''];
        $updateGroup = new UpdateGroup(self::YX_INNER_GROUP_NAME);
        foreach ($chatArr as $chatId) {
            $Type = strpos($chatId, '@') === 0 ? 2 : 1;
            $updateGroup->addGroupContactItem(
                new ContactUpdateItem(
                    self::ContactOptType_Del,
                    $Type == ContactItem::TYPE_C2C ? new ContactItem($Type, $chatId) : new ContactItem($Type, null, $chatId)
                )
            );
        }
        $item->setUpdateGroup($updateGroup);
        $this->sendRequest('/v4/recentcontact/update_contact_group', $item);
        echo "更新分组 ------- " . "\n";
    }

    /**
     * @param string $paramsJson
     * @return false|mixed
     */
    private function sendRequest($url, Model $contactListItem)
    {
        $paramsJson = $contactListItem->generateBody();

        $client = new Client();
        $headers = [
            'Accept' => 'application/json, text/plain, */*',
            'Sec-Fetch-Site' => 'cross-site',
            'Accept-Language' => 'zh-CN,zh-Hans;q=0.9',
            'Sec-Fetch-Mode' => 'cors',
            'Origin' => 'https://tcc.tencentcs.com',
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.1 Safari/605.1.15',
            'Referer' => 'https://tcc.tencentcs.com/',
            'Connection' => 'keep-alive',
            'Sec-Fetch-Dest' => 'empty',
            'Priority' => 'u=3, i',
            'Content-Type' => 'application/json'
        ];

        $appid = getenv('SDK_APPID');
        $identifier = getenv('SDK_IDENTIFIER');
        $usersig = getenv('SDK_USERSIG');
        $request = new Request('POST', "https://console.tim.qq.com$url?sdkappid=$appid&identifier=$identifier&usersig=$usersig&random=079924292&contenttype=json", $headers, $paramsJson);

        echo "请求参数:\n";
        echo $url . "\n";
        echo $paramsJson . "\n";
        echo "----------\n";

        try {
            $res = $client->sendAsync($request)->wait();
            $body = $res->getBody();

            echo "请求结果:\n";
            echo $body . "\n";
            echo "----------\n";

            $res = json_decode($body, true);
            // 失败
            if (!empty($res['ErrorCode']) || $res['ActionStatus'] !== 'OK') {
                echo 'Error: ' . $res['ErrorInfo'];
                throw new \Exception($res['ErrorInfo']);
            }
            // 成功
            return $res;
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    /**
     * @param $sessionItem
     * @param array $chatArr
     * @return bool 是否结束
     */
    public function parseToArr($res, array &$chatArr): bool
    {
        $sessionItem = $res['SessionItem'] ?? [];
        if (empty($sessionItem)) {
            return true;
        }
        foreach ($sessionItem as $item) {
            if ($item['Type'] == 1) {
                $chatId = $item['To_Account'];
            } else {
                $chatId = $item['GroupId'];
            }
            if (in_array($chatId, $chatArr)) {
                throw new \Exception('重复的会话ID: ' . $chatId);
            }
            $chatArr[] = $chatId;
        }
        return 1 === ($res['CompleteFlag'] ?? 0);
    }

    /**
     * @param int $userId
     * @param $timeStamp
     * @param $startIndex
     * @param $topTimeStamp
     * @param $topStartIndex
     * @return false|mixed
     */
    private function getContractList(int $userId, $timeStamp, $startIndex, $topTimeStamp, $topStartIndex)
    {
        $paramsObj = new GetContactListItem(
            "USER_" . $userId,
            $timeStamp,
            $startIndex,
            $topTimeStamp,
            $topStartIndex
        );
        $res = $this->sendRequest('/v4/recentcontact/get_list', $paramsObj);
        return $res;
    }

    public function testGetContractList()
    {
        $userId = self::User_test;
        $timeStamp = 0;
        $startIndex = 0;
        $topTimeStamp = 0;
        $topStartIndex = 0;

        $res = $this->getContractList($userId, $timeStamp, $startIndex, $topTimeStamp, $topStartIndex);
        $this->assertIsArray($res);
    }

    private function getContactGroup(int $userId, string $groupName)
    {
        $paramObj = new GetContactGroupItem("USER_" . $userId, 0);
        $res = $this->sendRequest('/v4/recentcontact/get_contact_group', $paramObj);

        if (empty($res['GroupItem'])) {
            echo "没有分组信息\n";
            return false;
        }
        $groupItem = $res['GroupItem'];
        $GroupNames = array_column($groupItem, 'GroupName');
        if (!in_array($groupName, $GroupNames)) {
            echo "没有inner分组信息\n";
            // todo 需要先创建分组信息
            return false;
        }
        return $res;
    }

    public function testGetContactGroup()
    {
        $res = $this->getContactGroup(self::User_test, self::YX_INNER_GROUP_NAME);
        $this->assertIsArray($res);
    }

    public function testCreateContactGroup()
    {
        $item = new CreateContactGroupItem("USER_" . self::User_test);

        $groupContactItem = new GroupContactItem(self::YX_INNER_GROUP_NAME);
        $groupContactItem->addContactItem(new ContactItem(ContactItem::TYPE_C2C, 'USER_' . self::User_test_1));

        $item->addGroupContactItem($groupContactItem);

        $res = $this->sendRequest('/v4/recentcontact/create_contact_group', $item);

        $this->assertIsArray($res);
    }

    public function testUpdateContractGroupName()
    {
        $item = new UpdateGroup('yx_inner');
        $item->updateGroupName('yx_inner_test');

        $obj = new UpdateContactGroupItem("USER_" . self::User_test);
        $obj->setUpdateGroup($item);
        $res = $this->sendRequest('/v4/recentcontact/update_contact_group', $obj);

        $this->assertIsArray($res);
    }

    public function testUpdateContractGroup()
    {
        $contact1 = new ContactItem(ContactItem::TYPE_C2C, 'USER_' . self::User_test_1);
        $toDel = new ContactUpdateItem(ContactUpdateItem::ContactOptType_Del, $contact1);

        $contact2 = new ContactItem(ContactItem::TYPE_GROUP, null, '@TGS#1XI7VDBOC');
        $toAdd = new ContactUpdateItem(ContactUpdateItem::ContactOptType_Add, $contact2);

        $item = new UpdateGroup('yx_inner_test');
        $item->addGroupContactItem($toDel)->addGroupContactItem($toAdd);

        $obj = new UpdateContactGroupItem("USER_" . self::User_test);
        $obj->setUpdateGroup($item);
        $res = $this->sendRequest('/v4/recentcontact/update_contact_group', $obj);

        $this->assertIsArray($res);
    }

}
