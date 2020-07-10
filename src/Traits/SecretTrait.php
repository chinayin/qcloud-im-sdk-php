<?php

namespace QcloudIM\Traits;

trait SecretTrait
{

    /**
     * @var string
     */
    protected $sdkAppId;

    /**
     * @param string $sdkAppId
     */
    public function setSdkAppId(string $sdkAppId): void
    {
        $this->sdkAppId = $sdkAppId;
    }

    public function getSdkAppId(): string
    {
        return $this->sdkAppId;
    }

    /**
     * @var string
     */
    protected $secret;

    /**
     * @param string $secret
     */
    public function setSecret(string $secret): void
    {
        $this->secret = $secret;
    }

    /**
     * @var string
     */
    protected $identifier;

    /**
     * @param string $identifier
     */
    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

}
