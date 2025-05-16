<?php

namespace QcloudIM\Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use QcloudIM\Model\Model;

trait SendRequestTrait
{

    /**
     * @param string $paramsJson
     * @return false|mixed
     */
    public function sendRequest($url, Model $model)
    {
        $paramsJson = $model->generateBody();

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
}
