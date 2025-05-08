<?php

namespace QcloudIM\Model;

use QcloudIM\Model\Model;

class UpdateGroup extends Model
{
    /** @var int 更新分组名 */
    public const UpdateGroupType_Name = 1;
    /** @var int 更新会话分组 */
    public const UpdateGroupType_ContactItem = 2;
    public $UpdateGroupType;

    public $OldGroupName;
    public $NewGroupName;
    public $ContactUpdateItem;

    public function __construct($OldGroupName)
    {
        $this->OldGroupName = $OldGroupName;
    }

    public function updateGroupName($NewGroupName)
    {
        $this->UpdateGroupType = self::UpdateGroupType_Name;
        $this->NewGroupName = $NewGroupName;
    }

    public function addGroupContactItem(ContactUpdateItem $ContactUpdateItem)
    {
        $this->UpdateGroupType = self::UpdateGroupType_ContactItem;
        $this->ContactUpdateItem[] = $ContactUpdateItem->toArray();
        return $this;
    }
}
