<?php

namespace QcloudIM\Api;

use QcloudIM\Constants;
use QcloudIM\Traits\HttpClientTrait;

/**
 * 账号管理
 */
class Account
{
    use HttpClientTrait;

    /**
     * 查询帐号
     *
     * @param string $accountId
     *
     * @return array
     */
    public function check(string $accountId): array
    {
        $r = $this->httpClient->postJson('im_open_login_svc/account_check', [
            'CheckItem' => [['UserID' => $accountId]],
        ]);
        return $r['ResultItem'][0];
    }

    /**
     * 批量查询账号
     *
     * @param array $accountIds
     *
     * @return array
     */
    public function batchCheck(array $accountIds): array
    {
        $r = $this->httpClient->postJson('im_open_login_svc/account_check', [
            'CheckItem' => array_map(function ($v) {
                return ['UserID' => $v];
            }, $accountIds),
        ]);
        return $r['ResultItem'];
    }

    /**
     * 失效帐号登录态
     *
     * @param string $accountId
     *
     * @return bool
     */
    public function kick(string $accountId): bool
    {
        $r = $this->httpClient->postJson('im_open_login_svc/kick', [
            'Identifier' => $accountId
        ]);
        return $r['ActionStatus'] === Constants::ACTION_STATUS_OK;
    }

    /**
     * 查询帐号在线状态
     *
     * @param string $accountId
     * @param bool   $isNeedDetail
     *
     * @return array
     */
    public function queryState(string $accountId, bool $isNeedDetail = false): array
    {
        $r = $this->httpClient->postJson('openim/querystate', [
            'IsNeedDetail' => $isNeedDetail ? 1 : 0,
            'To_Account' => [$accountId],
        ]);
        return $r['QueryResult'][0];
    }

    /**
     * 批量查询帐号在线状态
     *
     * @param array $accountIds
     * @param bool  $isNeedDetail
     *
     * @return array
     */
    public function batchQueryState(array $accountIds, bool $isNeedDetail = false): array
    {
        if (count($accountIds) > 500) {
            throw new \InvalidArgumentException('AccountIds size limit exceeded.', -1);
        }
        return $this->httpClient->postJson('openim/querystate', [
            'IsNeedDetail' => $isNeedDetail ? 1 : 0,
            'To_Account' => $accountIds,
        ]);
    }

    /**
     * 账号导入 (限速200次/秒)
     *
     * @param string $accountId
     * @param string $nick
     * @param string $faceUrl
     *
     * @return bool
     */
    public function import(string $accountId, string $nick, string $faceUrl): bool
    {
        $r = $this->httpClient->postJson('im_open_login_svc/account_import', [
            'Identifier' => $accountId,
            'Nick' => $nick,
            'FaceUrl' => $faceUrl,
        ]);
        return $r['ActionStatus'] === Constants::ACTION_STATUS_OK;
    }

    /**
     * 导入多个帐号 (单次最多100个,限速100次/秒)
     *
     * @param array $accountIds
     *
     * @return array
     */
    public function multiImport(array $accountIds)
    {
        if (count($accountIds) > 100) {
            throw new \InvalidArgumentException('AccountIds size limit exceeded.', -1);
        }
        return $this->httpClient->postJson('im_open_login_svc/multiaccount_import', [
            'Accounts' => $accountIds,
        ]);
    }

    /**
     * 删除账号 (单次最多100个,限速100次/秒)
     *
     * @param array $accountIds
     *
     * @return array
     */
    public function delete(array $accountIds)
    {
        if (count($accountIds) > 100) {
            throw new \InvalidArgumentException('AccountIds size limit exceeded.', -1);
        }
        $r = $this->httpClient->postJson('im_open_login_svc/account_delete', [
            'DeleteItem' => array_map(function ($v) {
                return ['UserID' => $v];
            }, $accountIds),
        ]);
        return $r['ResultItem'];
    }

}
