<?php

namespace QcloudIM\Model;

class UpdateContactGroupItem extends Model
{
    /** @var string 必填    请求方 uid */
    public $From_Account;

    /** @var int 必填    1 – 分组添加或删除会话 */
    public $UpdateType;

    /** @var object 必填    分组维度增删会话 */
    public $UpdateGroup;


    public function setFromAccount(string $From_Account): void
    {
        $this->From_Account = $From_Account;
    }

    public function setUpdateType(int $UpdateType): void
    {
        $this->UpdateType = $UpdateType;
    }

    public function setUpdateGroup(array $UpdateGroup): void
    {
        $this->UpdateGroup = $UpdateGroup;
    }

}
