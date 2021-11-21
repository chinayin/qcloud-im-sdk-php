<?php

namespace QcloudIM\Traits;

trait SecretTrait
{
    /**
     * @var string
     */
    protected $sdkAppId;

    /**
     * @var string
     */
    protected $secret;

    /**
     * @var string
     */
    protected $identifier;

    public function setSdkAppId(string $sdkAppId): void
    {
        $this->sdkAppId = $sdkAppId;
    }

    public function getSdkAppId(): string
    {
        return $this->sdkAppId;
    }

    public function setSecret(string $secret): void
    {
        $this->secret = $secret;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }
}
