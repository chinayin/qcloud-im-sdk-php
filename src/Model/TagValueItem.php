<?php

namespace QcloudIM\Model;

class TagValueItem extends Model
{
    /** @var string */
    public $Tag;
    public $Value;

    /**
     * TagValueItem constructor.
     *
     * @param $Value
     */
    public function __construct(string $Tag, $Value)
    {
        $this->Tag = $Tag;
        $this->Value = $Value;
    }

    public function getTag(): string
    {
        return $this->Tag;
    }

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
