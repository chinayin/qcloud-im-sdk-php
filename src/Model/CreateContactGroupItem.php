<?php

namespace QcloudIM\Model;

class CreateContactGroupItem extends Model
{
    public $From_Account;
    public $GroupContactItem;

    public function __construct(string $From_Account)
    {
        $this->From_Account = $From_Account;
    }

    public function addGroupContactItem(GroupContactItem $item)
    {
        $this->GroupContactItem[] = $item->toArray();
        return $this;
    }
}
