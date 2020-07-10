<?php

namespace QcloudIM\Model;

class AddFriendItem
{

    /** @var string */
    public $To_Account;
    /** @var string */
    public $Remark;
    /** @var string */
    public $GroupName;
    /** @var string */
    public $AddSource;
    /** @var string */
    public $AddWording;

    /**
     * AddFriendItem constructor.
     *
     * @param string $To_Account
     */
    public function __construct(string $To_Account)
    {
        $this->To_Account = $To_Account;
    }

    /**
     * @return string
     */
    public function getToAccount(): string
    {
        return $this->To_Account;
    }

    /**
     * @param string $To_Account
     */
    public function setToAccount(string $To_Account): void
    {
        $this->To_Account = $To_Account;
    }

    /**
     * @return string
     */
    public function getRemark(): string
    {
        return $this->Remark;
    }

    /**
     * @param string $Remark
     */
    public function setRemark(string $Remark): void
    {
        $this->Remark = $Remark;
    }

    /**
     * @return string
     */
    public function getGroupName(): string
    {
        return $this->GroupName;
    }

    /**
     * @param string $GroupName
     */
    public function setGroupName(string $GroupName): void
    {
        $this->GroupName = $GroupName;
    }

    /**
     * @return string
     */
    public function getAddSource(): string
    {
        return $this->AddSource;
    }

    /**
     * @param string $AddSource
     */
    public function setAddSource(string $AddSource): void
    {
        $this->AddSource = $AddSource;
    }

    /**
     * @return string
     */
    public function getAddWording(): string
    {
        return $this->AddWording;
    }

    /**
     * @param string $AddWording
     */
    public function setAddWording(string $AddWording): void
    {
        $this->AddWording = $AddWording;
    }

}
