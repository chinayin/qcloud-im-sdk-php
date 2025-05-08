<?php

namespace QcloudIM\Model;

class GroupContactItem extends Model
{
    public $GroupName;
    public $ContactItem;

    public function __construct($GroupName)
    {
        $this->GroupName = $GroupName;
    }

    public function addContactItem(ContactItem $item)
    {
        $this->ContactItem[] = $item->toArray();
        return $this;
    }
}
