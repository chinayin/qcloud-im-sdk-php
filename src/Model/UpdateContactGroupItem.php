<?php

namespace QcloudIM\Model;

class UpdateContactGroupItem extends Model
{
    /** @var string 必填    请求方 uid */
    public $From_Account;

    /** @var int 必填    1 – 分组添加或删除会话 */
    public $UpdateType;

    /** @var array 必填    分组维度增删会话 */
    public $UpdateGroup;

    public function __construct($From_Account)
    {
        $this->From_Account = $From_Account;
        $this->UpdateType = 1;
    }

    public function setUpdateGroup(UpdateGroup $UpdateGroup): void
    {
        $this->UpdateGroup = $UpdateGroup->toArray();
    }
}
