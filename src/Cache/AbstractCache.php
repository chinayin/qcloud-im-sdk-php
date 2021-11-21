<?php

namespace QcloudIM\Cache;

use QcloudIM\Traits\CacheTrait;

abstract class AbstractCache
{
    use CacheTrait;

    public function get(bool $refresh = false)
    {
        $key = $this->getCacheKey();
        $item = $this->cache->getItem($key);
        if ($refresh || !$item->isHit()) {
            $value = $this->getFromServer();
            $item->set($value);
            $item->expiresAfter($this->getCacheExpire());
            $this->cache->save($item);

            return $value;
        }

        return $item->get();
    }

    abstract protected function getCacheKey(): string;

    abstract protected function getCacheExpire(): int;

    /**
     * @return mixed
     */
    abstract protected function getFromServer();
}
