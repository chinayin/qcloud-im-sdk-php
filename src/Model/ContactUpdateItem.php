<?php

namespace QcloudIM\Model;

class ContactUpdateItem extends Model
{
    /** @var int 更新类型:分组添加会话 */
    public const ContactOptType_Add = 1;
    /** @var int 更新类型:分组删除会话 */
    public const ContactOptType_Del = 2;

    public $ContactOptType;

    public $ContactItem;

    public function __construct($ContactOptType, ContactItem $ContactItem)
    {
        $this->ContactOptType = $ContactOptType;
        $this->ContactItem = $ContactItem->toArray();
    }
}
