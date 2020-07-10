<?php

namespace QcloudIM\Http;

class Response extends \GuzzleHttp\Psr7\Response
{
    /**
     * @inheritdoc
     */
    public function getBody()
    {
        $stream = parent::getBody();
        $data = json_decode((string)$stream, true);
        if (JSON_ERROR_NONE === json_last_error() && $data['ErrorCode'] !== 0) {
            throw new \InvalidArgumentException($data['ErrorInfo'], $data['ErrorCode']);
        }
        return $stream;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return \GuzzleHttp\json_decode((string)$this->getBody(), true);
    }
}
