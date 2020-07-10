<?php

namespace QcloudIM\Api;

use QcloudIM\Traits\HttpClientTrait;

/**
 * 全局管理
 */
class GlobalConfig
{
    use HttpClientTrait;

    /**
     * 获取服务器IP地址
     *
     * @return array
     */
    public function getIpList(): array
    {
        $r = $this->httpClient->postJson('ConfigSvc/GetIPList', ['t' => time()]);
        return $r['IPList'];
    }

    /**
     * 查询全局禁言
     *
     * @param string $accountId
     *
     * @return array
     */
    public function getNoSpeaking(string $accountId): array
    {
        $r = $this->httpClient->postJson('openconfigsvr/getnospeaking', [
            'Get_Account' => $accountId
        ]);
        return $r;
    }

    /**
     * 设置全局禁言
     *
     * @param string $accountId
     * @param int    $C2CmsgNospeakingTime   单聊消息禁言时间，单位为秒，非负整数，最大值为4294967295（十六进制 0xFFFFFFFF）
     *                                       0表示取消该帐号的单聊消息禁言
     *                                       4294967295表示该帐号被设置永久禁言
     *                                       其它值表示该帐号具体的禁言时间
     * @param int    $GroupmsgNospeakingTime 群组消息禁言时间，单位为秒，非负整数，最大值为4294967295（十六进制 0xFFFFFFFF）
     *                                       0表示取消该帐号的群组消息禁言
     *                                       4294967295表示该帐号被设置永久禁言
     *                                       其它值表示该帐号的具体禁言时间
     *
     * @return bool
     */
    public function setNoSpeaking(string $accountId, int $C2CmsgNospeakingTime, int $GroupmsgNospeakingTime): bool
    {
        $r = $this->httpClient->postJson('openconfigsvr/setnospeaking', [
            'Set_Account' => $accountId,
            'C2CmsgNospeakingTime' => $C2CmsgNospeakingTime,
            'GroupmsgNospeakingTime' => $GroupmsgNospeakingTime,
        ]);
        return $r['ErrorCode'] === 0;
    }

    /**
     * 拉取运营数据
     *
     * @param array $requestField
     *
     * @return array
     */
    public function getAppInfo(array $requestField = []): array
    {
        $r = $this->httpClient->postJson('openconfigsvr/getappinfo',
            empty($requestField) ? ['t' => time()] : ['RequestField' => $requestField]
        );
        return $r['Result'];
    }

    /**
     * 下载最近消息记录
     * App 管理员可以通过该接口获取 App 中最近7天中某天某小时的所有单发或群组消息记录的下载地址
     *
     * @param string $chatType 消息类型，C2C 表示单发消息 Group 表示群组消息
     * @param string $msgTime  需要下载的消息记录的时间段，2015120121表示获取2015年12月1日21:00 - 21:59的消息的下载地址。
     *                         该字段需精确到小时。每次请求只能获取某天某小时的所有单发或群组消息记录
     *
     * @return array
     */
    public function getHistory(string $chatType, string $msgTime): array
    {
        $r = $this->httpClient->postJson('open_msg_svc/get_history', [
            'ChatType' => $chatType, 'MsgTime' => $msgTime,
        ]);
        return $r['File'];
    }

}
