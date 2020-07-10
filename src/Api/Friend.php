<?php

namespace QcloudIM\Api;

use Psr\Log\InvalidArgumentException;
use QcloudIM\Model\AddFriendItem;
use QcloudIM\Traits\HttpClientTrait;

/**
 * 关系链管理(好友)
 */
class Friend
{
    use HttpClientTrait;

    public function add(string $fromAccountId, AddFriendItem $item)
    {
        $aa = [
            'From_Account' => $fromAccountId,
            'AddFriendItem' => [
                $item
            ]
        ];
        var_dump($aa);
        var_dump(json_encode($aa));
        return $this->httpClient->postJson('sns/friend_add', [
            'From_Account' => $fromAccountId,
            'AddFriendItem' => [
                $item
            ]
        ]);
    }



}
