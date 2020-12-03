<?php

namespace QcloudIM\Cache;

use QcloudIM\Traits\CacheTrait;

abstract class AbstractCache
{
    use CacheTrait;

    /**
     * @return string
     */
    abstract protected function getCacheKey(): string;

    /**
     * @return int
     */
    abstract protected function getCacheExpire(): int;

    /**
     * @return mixed
     */
    abstract protected function getFromServer();

    /**
     * @param bool $refresh
     *
     * @return mixed
     * @throws \Psr\Cache\InvalidArgumentException
     */
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
}
