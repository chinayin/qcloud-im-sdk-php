<?php

namespace QcloudIM\Model;

class KeyValueItem
{

    /** @var string */
    public $Key;
    public $Value;

    /**
     * KeyValueItem constructor.
     *
     * @param string $Key
     * @param        $Value
     */
    public function __construct(string $Key, $Value)
    {
        $this->Key = $Key;
        $this->Value = $Value;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->Key;
    }

    /**
     * @param string $Key
     */
    public function setKey(string $Key): void
    {
        $this->Key = $Key;
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
