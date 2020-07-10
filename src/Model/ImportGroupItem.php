<?php

namespace QcloudIM\Model;

class ImportGroupItem extends CreateGroupItem
{
    /** @var int 群组的创建时间（选填，不填会以请求时刻为准） */
    public $CreateTime;

    /**
     * @return int
     */
    public function getCreateTime(): int
    {
        return $this->CreateTime;
    }

    /**
     * @param int $CreateTime
     */
    public function setCreateTime(int $CreateTime): void
    {
        $this->CreateTime = $CreateTime;
    }

}
