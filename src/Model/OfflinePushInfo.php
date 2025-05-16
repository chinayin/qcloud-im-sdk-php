<?php

namespace QcloudIM\Model;

class OfflinePushInfo extends Model
{
    const PUSH_FLAG_0 = 0;
    const PUSH_FLAG_1 = 1;

    public $PushFlag;
    public $Title;

    public $Desc;
    public $Ext;

    /**
     * @var array
     */
    public $AndroidInfo;
    /**
     * @var array
     */
    public $ApnsInfo;

    /**
     * @return int
     */
    public function getPushFlag()
    {
        return $this->PushFlag;
    }

    /**
     * @param int $PushFlag
     * @return OfflinePushInfo
     */
    public function setPushFlag($PushFlag)
    {
        $this->PushFlag = $PushFlag;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->Title;
    }

    /**
     * @param string $Title
     * @return OfflinePushInfo
     */
    public function setTitle($Title)
    {
        $this->Title = $Title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDesc()
    {
        return $this->Desc;
    }

    /**
     * @param string $Desc
     * @return OfflinePushInfo
     */
    public function setDesc($Desc)
    {
        $this->Desc = $Desc;
        return $this;
    }

    /**
     * @return string
     */
    public function getExt()
    {
        return $this->Ext;
    }

    /**
     * @param string $Ext json
     * @return OfflinePushInfo
     */
    public function setExt($Ext)
    {
        $this->Ext = $Ext;
        return $this;
    }

    /**
     * @return array
     */
    public function getAndroidInfo()
    {
        return $this->AndroidInfo;
    }

    /**
     * @param array $AndroidInfo
     * @return OfflinePushInfo
     */
    public function setAndroidInfo(array $AndroidInfo)
    {
        $this->AndroidInfo = $AndroidInfo;
        return $this;
    }

    /**
     * @return array
     */
    public function getApnsInfo()
    {
        return $this->ApnsInfo;
    }

    /**
     * @param array $ApnsInfo
     * @return OfflinePushInfo
     */
    public function setApnsInfo(array $ApnsInfo)
    {
        $this->ApnsInfo = $ApnsInfo;
        return $this;
    }

}
