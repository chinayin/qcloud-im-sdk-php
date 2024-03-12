<?php

namespace QcloudIM\Api;

use QcloudIM\Constants;
use QcloudIM\Traits\HttpClientTrait;

/**
 * 机器人
 */
class Robot
{
    use HttpClientTrait;

    /**
     * 创建机器人
     * 创建一个机器人账号，机器人是一种特殊账号，userid必须以@RBT#开头，创建机器人时可以指定设置昵称、头像和签名。
     *
     * 同一个机器人账号userid重复创建仅会创建1个机器人。
     * 每个 IM 账号只能创建最多20个机器人账号。
     *
     * @param string $userId 机器人账号
     * @param string $nick 机器人昵称
     * @param string $faceUrl 机器人头像URL
     * @param string $signature 机器人签名
     *
     * @link https://cloud.tencent.com/document/product/269/89991
     */
    public function createRobot(string $userId, string $nick, string $faceUrl, string $signature = ''): bool
    {
        if (empty($userId)) {
            throw new \InvalidArgumentException('Invalid Params UserId.', -1);
        }
        if (strpos($userId, Constants::ROBOT_PREFIX) !== 0) {
            throw new \InvalidArgumentException('UserId must start with @RBT#.', -1);
        }

        $r = $this->httpClient->postJson('openim_robot_http_svc/create_robot', [
            'UserID' => $userId,
            'Nick' => $nick,
            'FaceUrl' => $faceUrl,
            'SelfSignature' => $signature,
        ]);
        return Constants::ACTION_STATUS_OK === $r['ActionStatus'];
    }


    /**
     * 删除机器人
     * 将一个机器人账号设置为无效，机器人是一种特殊账号，userid必须以@RBT#开头。
     *
     * 本接口将一个机器人账号设置为无效。
     * 机器人账号 UserID 本身不会被删除。
     *
     * @param string $userId 机器人账号
     *
     * @link https://cloud.tencent.com/document/product/269/89992
     */
    public function deleteRobot(string $userId): bool
    {
        if (empty($userId)) {
            throw new \InvalidArgumentException('Invalid Params UserId.', -1);
        }
        if (strpos($userId, Constants::ROBOT_PREFIX) !== 0) {
            throw new \InvalidArgumentException('UserId must start with @RBT#.', -1);
        }

        $r = $this->httpClient->postJson('openim_robot_http_svc/delete_robot', [
            'Robot_Account' => $userId,
        ]);
        return Constants::ACTION_STATUS_OK === $r['ActionStatus'];
    }


    /**
     * 拉取所有机器人
     *
     * @link https://cloud.tencent.com/document/product/269/89993
     */
    public function getAllRobots(): array
    {
        $r = $this->httpClient->postJson('openim_robot_http_svc/get_all_robots');

        if (Constants::ACTION_STATUS_OK !== $r['ActionStatus']) {
            throw new \ErrorException($r['ErrorInfo'], $r['ErrorCode']);
        }

        return $r['Robot_Account'];
    }

}
