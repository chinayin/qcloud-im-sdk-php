<?php

namespace QcloudIM\Model;

class TagValueItem
{

    /** @var string */
    public $Tag;
    public $Value;

    /**
     * TagValueItem constructor.
     *
     * @param string $Tag
     * @param        $Value
     */
    public function __construct(string $Tag, $Value)
    {
        $this->Tag = $Tag;
        $this->Value = $Value;
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->Tag;
    }

    /**
     * @param string $Tag
     */
    public function setTag(string $Tag): void
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
