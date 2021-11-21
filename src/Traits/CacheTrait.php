<?php

namespace QcloudIM\Traits;

use Psr\Cache\CacheItemPoolInterface;

trait CacheTrait
{
    /**
     * @var CacheItemPoolInterface
     */
    protected $cache;

    public function setCache(CacheItemPoolInterface $cache): void
    {
        $this->cache = $cache;
    }
}
