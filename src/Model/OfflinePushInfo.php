<?php

namespace QcloudIM\Model;

class OfflinePushInfo extends Model
{
    const PUSH_FLAG_0 = 0;
    const PUSH_FLAG_1 = 1;

    public $PushFlag;
    public $Title;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->Title;
    }

    /**
     * @param mixed $Title
     * @return OfflinePushInfo
     */
    public function setTitle($Title)
    {
        $this->Title = $Title;
        return $this;
    }
    public $Desc;
    public $Ext;

    public $AndroidInfo;
    public $ApnsInfo;

    /**
     * @return mixed
     */
    public function getPushFlag()
    {
        return $this->PushFlag;
    }

    /**
     * @param mixed $PushFlag
     * @return OfflinePushInfo
     */
    public function setPushFlag($PushFlag)
    {
        $this->PushFlag = $PushFlag;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return $this->Desc;
    }

    /**
     * @param mixed $Desc
     * @return OfflinePushInfo
     */
    public function setDesc($Desc)
    {
        $this->Desc = $Desc;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExt()
    {
        return $this->Ext;
    }

    /**
     * @param mixed $Ext
     * @return OfflinePushInfo
     */
    public function setExt($Ext)
    {
        $this->Ext = $Ext;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAndroidInfo()
    {
        return $this->AndroidInfo;
    }

    /**
     * @param mixed $AndroidInfo
     * @return OfflinePushInfo
     */
    public function setAndroidInfo(array $AndroidInfo)
    {
        $this->AndroidInfo = $AndroidInfo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApnsInfo()
    {
        return $this->ApnsInfo;
    }

    /**
     * @param mixed $ApnsInfo
     * @return OfflinePushInfo
     */
    public function setApnsInfo(array $ApnsInfo)
    {
        $this->ApnsInfo = $ApnsInfo;
        return $this;
    }

}
