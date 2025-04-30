<?php

namespace QcloudIM\Tests\Feature\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use QcloudIM\Api\RecentContact;
use QcloudIM\Model\GetContactGroupItem;
use QcloudIM\Model\GetContactListItem;
use QcloudIM\Model\Model;
use QcloudIM\Model\UpdateContactGroupItem;

class DemoTest extends TestCase
{
    const TopFlag_YES = 1;
    const TopFlag_NO = 0;
    const User_deli_1 = 5158;
    const User_deli_2 = 6116;
    const INNER_GROUP_NAME = 'inner';
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
        $userId = self::User_deli_1;

        $startIndex = 0;
        $timeStamp = 0;
        $topStartIndex = 0;
        $topTimeStamp = 0;
        echo "开始 遍历普通会话" . $startIndex . "\n";
        $isFinish = false;

        while (!$isFinish) {
            echo "开始 " . $startIndex . "\n";

            $paramsObj = new GetContactListItem(
                "USER_" . $userId,
                $timeStamp,
                $startIndex,
                $topTimeStamp,
                $topStartIndex
            );
            $res = $this->sendRequest('/v4/recentcontact/get_list', $paramsObj);
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

//        var_dump($chatArr);

        $hasContact = $this->getContactGroup($userId);
        if ($hasContact) {
            $item = new UpdateContactGroupItem();
            $item->setFromAccount('USER_' . $userId);
            $item->setUpdateType(1);

            $ContactUpdateItem = [];
            foreach ($chatArr as $chatId) {

                $Type = strpos($chatId, '@') === 0 ? 2 : 1;
                $Key = $Type == 1 ? 'To_Account' : 'ToGroupId';
                $ContactUpdateItem[] = [
                    'ContactOptType' => 1,
                    'ContactItem' => [
                        'Type' => $Type,
                        $Key => $chatId,
                    ],
                ];
            }

            $item->setUpdateGroup(
                [
                    'UpdateGroupType' => 2,
                    "OldGroupName" => self::INNER_GROUP_NAME,
                    'ContactUpdateItem' => $ContactUpdateItem,
                ]
            );

            $uptRes = $this->sendRequest('/v4/recentcontact/update_contact_group', $item);
            echo "更新分组 ------- " . "\n";
            var_dump($uptRes);
        }
    }

    public function testDelGroupFromContact()
    {
        $item = new UpdateContactGroupItem();
        $item->setFromAccount('USER_' . self::User_deli_1);
        $item->setUpdateType(1);

        $chatArr = ['@TGS#266VY6SQU', '@TGS#2YYHN6SQD'];
        $ContactUpdateItem = [];
        foreach ($chatArr as $chatId) {

            $Type = strpos($chatId, '@') === 0 ? 2 : 1;
            $Key = $Type == 1 ? 'To_Account' : 'ToGroupId';
            $ContactUpdateItem[] = [
                'ContactOptType' => self::ContactOptType_Del,
                'ContactItem' => [
                    'Type' => $Type,
                    $Key => $chatId,
                ],
            ];
        }

        $item->setUpdateGroup(
            [
                'UpdateGroupType' => self::UpdateGroupType_Item,
                "OldGroupName" => self::INNER_GROUP_NAME,
                'ContactUpdateItem' => $ContactUpdateItem,
            ]
        );

        $uptRes = $this->sendRequest('/v4/recentcontact/update_contact_group', $item);
        var_dump($uptRes);
        echo "更新分组 ------- " . "\n";
    }

    /**
     * @param string $paramsJson
     * @return false|mixed
     */
    public function sendRequest($url, Model $contactListItem)
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

        $request = new Request('POST', 'https://console.tim.qq.com' . $url . '?sdkappid=1400321302&identifier=admin&usersig=eJyrVgrxCdYrSy1SslIy0jNQ0gHzM1NS80oy0zLBwokpuZl5UInilOzEgoLMFCUrQxMDA2MjQ2MDI4hMakVBZlEqUNzU1NTIwMAAIlqSmQsSMzcxtTAGCppDTclMB5qb6*iSFZkbWuYa5mJpWBWjb25cauTqEuRX5JdrGZoSEG6UFOSYk5Qf7GyRG2irVAsAQzMxIA__&random=079924292&contenttype=json', $headers, $paramsJson);

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

    private function filter($param, int $TopFlag_YES)
    {
        $arr = [];
        foreach ($param as $item) {
            if ($item['TopFlag'] == $TopFlag_YES) {
                $arr[] = $item;
            }
        }
        return $arr;
    }

    private function getContactGroup(int $userId)
    {
        $paramObj = new GetContactGroupItem("USER_" . $userId, 0);
        $res = $this->sendRequest('/v4/recentcontact/get_contact_group', $paramObj);

        //{"ContactItem":[{"Type":2,"ToGroupId":"@TGS#1GF45ASQY","StandardMark":"10000000000000000000000000000000000","ContactGroupId":[1],"Timestamp":1744794702},{"Type":2,"ToGroupId":"@TGS#1ZIJ3CSQG","StandardMark":"","ContactGroupId":[1],"Timestamp":1744794834},{"Type":2,"ToGroupId":"@TGS#1MLV5BVQM","StandardMark":"","ContactGroupId":[1,2],"Timestamp":1745810706},{"Type":2,"ToGroupId":"@TGS#1ORX5BVQW","StandardMark":"","ContactGroupId":[1,2],"Timestamp":1745810706}],"CompleteFlag":1,"CompleteTime":1745810706,"GroupItem":[{"GroupName":"inner","GroupId":1},{"GroupName":"inner_test","GroupId":2}],"ActionStatus":"OK","ErrorCode":0,"ErrorInfo":"","ErrorDisplay":""}
        echo json_encode($res, JSON_UNESCAPED_UNICODE) . "\n";

        if (empty($res['GroupItem'])) {
            echo "没有分组信息\n";
            // todo 需要先创建分组信息
            return false;
        }
        $groupItem = $res['GroupItem'];
        $GroupNames = array_column($groupItem, 'GroupName');
        if (!in_array(self::INNER_GROUP_NAME, $GroupNames)) {
            echo "没有inner分组信息\n";
            // todo 需要先创建分组信息
            return false;
        }
        return $res;
    }
}
