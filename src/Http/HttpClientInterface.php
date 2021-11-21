<?php

namespace QcloudIM\Http;

use Psr\Http\Message\StreamInterface;

interface HttpClientInterface
{
    public function get(string $uri, array $query = []): array;

    public function getStream(string $uri, array $query = []): StreamInterface;

    public function postJson(string $uri, array $json = [], array $query = []): array;

    public function postFile(string $uri, string $path, array $query = []): array;
}
