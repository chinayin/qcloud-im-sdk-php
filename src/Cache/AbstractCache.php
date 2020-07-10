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
     */
    public function get(bool $refresh = false)
    {
        $key = $this->getCacheKey();
        $value = $this->cache->get($key);
        if ($refresh || !$value) {
            $value = $this->getFromServer();
            $this->cache->set($key, $value, $this->getCacheExpire());
        }
        return $value;
    }
}
