<?php

namespace QcloudIM\Model;

class Model
{
    public function toArray(): array
    {
        return array_filter((array) $this, function ($v) {
            return null !== $v;
        });
    }

    public function generateBody(): string
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE);
    }
}
