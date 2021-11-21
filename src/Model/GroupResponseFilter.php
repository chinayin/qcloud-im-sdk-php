<?php

namespace QcloudIM\Model;

class GroupResponseFilter extends Model
{
    /** @var array 基础信息字段 */
    public $GroupBaseInfoFilter;
    /** @var array 成员信息 */
    public $MemberInfoFilter;
    /** @var array 群组维度的自定义字段过滤 */
    public $AppDefinedDataFilter_Group;
    /** @var array 群成员维度自定义字段过滤 */
    public $AppDefinedDataFilter_GroupMember;

    public function getGroupBaseInfoFilter(): array
    {
        return $this->GroupBaseInfoFilter;
    }

    public function setGroupBaseInfoFilter(array $GroupBaseInfoFilter): void
    {
        $this->GroupBaseInfoFilter = $GroupBaseInfoFilter;
    }

    public function getMemberInfoFilter(): array
    {
        return $this->MemberInfoFilter;
    }

    public function setMemberInfoFilter(array $MemberInfoFilter): void
    {
        $this->MemberInfoFilter = $MemberInfoFilter;
    }

    public function getAppDefinedDataFilterGroup(): array
    {
        return $this->AppDefinedDataFilter_Group;
    }

    public function setAppDefinedDataFilterGroup(array $AppDefinedDataFilter_Group): void
    {
        $this->AppDefinedDataFilter_Group = $AppDefinedDataFilter_Group;
    }

    public function getAppDefinedDataFilterGroupMember(): array
    {
        return $this->AppDefinedDataFilter_GroupMember;
    }

    public function setAppDefinedDataFilterGroupMember(array $AppDefinedDataFilter_GroupMember): void
    {
        $this->AppDefinedDataFilter_GroupMember = $AppDefinedDataFilter_GroupMember;
    }
}
