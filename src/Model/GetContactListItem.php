<?php

namespace QcloudIM\Model;

use QcloudIM\Constants;

class GetContactListItem extends Model
{
    /**
     * $params = [
     * "From_Account" => "USER_" . $userId,
     * "TimeStamp" => $TimeStamp,
     * "StartIndex" => $startIndex,
     * "TopTimeStamp" => $TopTimeStamp,
     * "TopStartIndex" => $topStartIndex,
     * "AssistFlags" => 15,
     * ];
     */


    /** @var string */
    public $From_Account;
    /** @var int */
    public $TimeStamp;
    /** @var int */
    public $StartIndex;
    /** @var int */
    public $TopTimeStamp;
    /** @var int */
    public $TopStartIndex;
    /** @var int */
    public $AssistFlags;

    /**
     * AddFriendItem constructor.
     */
    public function __construct(string $From_Account, int $TimeStamp, int $StartIndex, int $TopTimeStamp, int $TopStartIndex)
    {
        $this->From_Account = $From_Account;
        $this->TimeStamp = $TimeStamp;
        $this->StartIndex = $StartIndex;
        $this->TopTimeStamp = $TopTimeStamp;
        $this->TopStartIndex = $TopStartIndex;
        $this->AssistFlags = 15;
    }

    public function getUrl()
    {
        return $this->Url;
    }
}
