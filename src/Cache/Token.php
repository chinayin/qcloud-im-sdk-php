<?php

namespace QcloudIM\Cache;

use QcloudIM\Crypt\TLSSigAPIv2;
use QcloudIM\Traits\HttpClientTrait;
use QcloudIM\Traits\SecretTrait;

class Token extends AbstractCache
{
    use HttpClientTrait, SecretTrait;

    protected function getCacheKey(): string
    {
        $unique = md5("{$this->sdkAppId}__{$this->secret}__{$this->identifier}");
        return md5('qcloudim.token.' . $unique);
    }

    protected function getCacheExpire(): int
    {
        return 3600 * 24 * 7;
    }

    /**
     * @return string
     * @throws \Exception
     */
    protected function getFromServer(): string
    {
        $m = new TLSSigAPIv2($this->sdkAppId, $this->secret);
        return $m->genSig($this->identifier, $this->getCacheExpire() + 600);
    }
}
