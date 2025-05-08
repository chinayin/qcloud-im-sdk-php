<?php

namespace QcloudIM\Model;

class ContactItem extends Model
{

    /** @var int 会话类型：C2C */
    public const TYPE_C2C = 1;
    /** @var int 会话类型：GROUP */
    public const TYPE_GROUP = 2;

    public $Type;
    public $To_Account;
    public $ToGroupId;

    public function __construct(int $Type, string $To_Account = null, string $ToGroupId = null)
    {
        $this->Type = $Type;
        $this->To_Account = $To_Account;
        $this->ToGroupId = $ToGroupId;
    }
}
