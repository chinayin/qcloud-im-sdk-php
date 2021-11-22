<?php

namespace QcloudIM\Http;

use Psr\Http\Message\StreamInterface;

class Response extends \GuzzleHttp\Psr7\Response
{
    public function getBody(): StreamInterface
    {
        $stream = parent::getBody();
        $data = json_decode((string)$stream, true);
        if (JSON_ERROR_NONE === json_last_error() && 0 !== $data['ErrorCode']) {
            throw new \InvalidArgumentException($data['ErrorInfo'], $data['ErrorCode']);
        }

        return $stream;
    }

    public function toArray(): array
    {
        return \GuzzleHttp\json_decode((string)$this->getBody(), true);
    }
}
