<?php

namespace QcloudIM\Model;

class ProfileItem
{

    public $Tag;
    public $Value;

    /**
     * ProfileItem constructor.
     *
     * @param $Tag
     * @param $Value
     */
    public function __construct($Tag, $Value)
    {
        $this->Tag = $Tag;
        $this->Value = $Value;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->Tag;
    }

    /**
     * @param mixed $Tag
     */
    public function setTag($Tag): void
    {
        $this->Tag = $Tag;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->Value;
    }

    /**
     * @param mixed $Value
     */
    public function setValue($Value): void
    {
        $this->Value = $Value;
    }

}
