<?php

namespace QcloudIM\Model;

class KeyValueItem extends Model
{
    /** @var string */
    public $Key;
    public $Value;

    /**
     * KeyValueItem constructor.
     *
     * @param $Value
     */
    public function __construct(string $Key, $Value)
    {
        $this->Key = $Key;
        $this->Value = $Value;
    }

    public function getKey(): string
    {
        return $this->Key;
    }

    public function setKey(string $Key): void
    {
        $this->Key = $Key;
    }

    public function getValue()
    {
        return $this->Value;
    }

    public function setValue($Value): void
    {
        $this->Value = $Value;
    }
}
