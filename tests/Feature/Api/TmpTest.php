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

class TmpTest extends TestCase
{
    const TopFlag_YES = 1;
    const TopFlag_NO = 0;
    const User_deli_1 = 5158;
    const User_deli_2 = 6116;
    const INNER_GROUP_NAME = 'inner';

    /**
     * @var RecentContact
     */
    protected $recentContact;

    public function testDemo()
    {
        $json = '{"SessionItem":[{"Type":2,"GroupId":"@TGS#12IUFNGQ2","MsgTime":1745829903,"TopFlag":1},{"Type":2,"GroupId":"@TGS#1EIOGUQQ2","MsgTime":1744252122,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1F45VLQQR","MsgTime":1744369974,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1QYBM3RQO","MsgTime":1744629207,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1FASL3RQ2","MsgTime":1744629267,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1CQWQ3RQR","MsgTime":1744630242,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1VTIR3RQ2","MsgTime":1744630364,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1ATDS3RQB","MsgTime":1744630574,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1HFIS3RQ6","MsgTime":1744630608,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1EENXASQU","MsgTime":1744696212,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1NQTZASQS","MsgTime":1744696506,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1ZYV6ASQE","MsgTime":1744697482,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1ZIJ3CSQG","MsgTime":1744713983,"TopFlag":0},{"Type":1,"To_Account":"USER_6184","MsgTime":1744857768,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1FP7GRSQJ","MsgTime":1744872783,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1XFBRSSQJ","MsgTime":1744887534,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1J6OS3RQW","MsgTime":1744966666,"TopFlag":0},{"Type":1,"To_Account":"USER_6662","MsgTime":1745230175,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1ZM5UQTQH","MsgTime":1745233461,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1YOIXQTQA","MsgTime":1745235271,"TopFlag":0},{"Type":2,"GroupId":"@TGS#17RPAZSQX","MsgTime":1745299970,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1XRVADRNF","MsgTime":1745310323,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1QQ3NXTQA","MsgTime":1745310431,"TopFlag":0},{"Type":1,"To_Account":"USER_4741","MsgTime":1745392455,"TopFlag":0},{"Type":2,"GroupId":"@TGS#266VY6SQU","MsgTime":1745546572,"TopFlag":0},{"Type":2,"GroupId":"@TGS#2YYHN6SQD","MsgTime":1745546605,"TopFlag":0},{"Type":1,"To_Account":"USER_528","MsgTime":1745551972,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1OBKUV3NH","MsgTime":1745575292,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1LQPWVTN4","MsgTime":1745579513,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1ZOF7YSQD","MsgTime":1745718126,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1Q6A6TBOB","MsgTime":1745725984,"TopFlag":0},{"Type":2,"GroupId":"@TGS#16GMYGYPS","MsgTime":1745736564,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1BJU6YSQT","MsgTime":1745751641,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1MLV5BVQM","MsgTime":1745810581,"TopFlag":0},{"Type":1,"To_Account":"USER_3363","MsgTime":1745824718,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1ORX5BVQW","MsgTime":1745836486,"TopFlag":0},{"Type":1,"To_Account":"USER_1097","MsgTime":1745908252,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1FSQ3QQON","MsgTime":1745912260,"TopFlag":0},{"Type":2,"GroupId":"@TGS#15PQRX2N6","MsgTime":1745920862,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1OBORKVNB","MsgTime":1745923195,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1GF45ASQY","MsgTime":1745935228,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1BM56XWNV","MsgTime":1745940608,"TopFlag":0},{"Type":2,"GroupId":"@TGS#1RDEH5UNZ","MsgTime":1745981876,"TopFlag":0},{"Type":1,"To_Account":"USER_316","MsgTime":1745982218,"TopFlag":0}],"CompleteFlag":1,"TimeStamp":1745996393,"StartIndex":0,"TopTimeStamp":1745996393,"TopStartIndex":0,"ActionStatus":"OK","ErrorCode":0,"ErrorInfo":"","ErrorDisplay":""}';

        $arr = json_decode($json, true);

        $chatGroup = [];
        $chatUser = [];
        $sessionItem = $arr['SessionItem'] ?? [];
        foreach ($sessionItem as $item) {
            if ($item['Type'] == 1) {
                $chatUser[] = $item['To_Account'];
            } else {
                $chatGroup[] = $item['GroupId'];
            }
        }
        echo implode('","', $chatGroup) . "\n";
        echo implode('","', $chatUser);
    }
}
