<?php

namespace QcloudIM\Model;

class GroupMemberInfoResponseFilter
{
    /** @var array 成员信息 */
    public $MemberInfoFilter;
    /** @var array 拉取指定身份的群成员资料。如没有填写该字段，默认为所有身份成员资料，成员身份可以为：“Owner”，“Admin”，“Member” */
    public $MemberRoleFilter;
    /** @var array 群成员维度自定义字段过滤 */
    public $AppDefinedDataFilter_GroupMember;

    /**
     * @return array
     */
    public function getMemberInfoFilter(): array
    {
        return $this->MemberInfoFilter;
    }

    /**
     * @param array $MemberInfoFilter
     */
    public function setMemberInfoFilter(array $MemberInfoFilter): void
    {
        $this->MemberInfoFilter = $MemberInfoFilter;
    }

    /**
     * @return array
     */
    public function getMemberRoleFilter(): array
    {
        return $this->MemberRoleFilter;
    }

    /**
     * @param array $MemberRoleFilter
     */
    public function setMemberRoleFilter(array $MemberRoleFilter): void
    {
        $this->MemberRoleFilter = $MemberRoleFilter;
    }

    /**
     * @return array
     */
    public function getAppDefinedDataFilterGroupMember(): array
    {
        return $this->AppDefinedDataFilter_GroupMember;
    }

    /**
     * @param array $AppDefinedDataFilter_GroupMember
     */
    public function setAppDefinedDataFilterGroupMember(array $AppDefinedDataFilter_GroupMember): void
    {
        $this->AppDefinedDataFilter_GroupMember = $AppDefinedDataFilter_GroupMember;
    }

}

