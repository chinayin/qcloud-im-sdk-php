<?php

namespace QcloudIM\Model;

class GetContactGroupItem extends Model
{
    /** @var string */
    public $From_Account;
    /** @var int */
    /** @var int */
    public $StartIndex;


    /**
     * AddFriendItem constructor.
     */
    public function __construct(string $From_Account, int $StartIndex)
    {
        $this->From_Account = $From_Account;
        $this->StartIndex = $StartIndex;
    }
}
