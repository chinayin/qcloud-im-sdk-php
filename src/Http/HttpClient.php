<?php

namespace QcloudIM\Http;

use GuzzleHttp\Client;
use Psr\Http\Message\StreamInterface;

class HttpClient implements HttpClientInterface
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get(string $uri, array $query = []): array
    {
        return $this->client->get($uri, compact('query'))->toArray();
    }

    public function getStream(string $uri, array $query = []): StreamInterface
    {
        return $this->client->get($uri, compact('query'))->getBody();
    }

    public function postJson(string $uri, array $json = [], array $query = []): array
    {
        return $this->client->post($uri, compact('json', 'query'))->toArray();
    }

    public function postFile(string $uri, string $path, array $query = []): array
    {
        return $this->client->post($uri, array_merge([
            'multipart' => [
                [
                    'name' => 'media',
                    'contents' => fopen($path, 'r'),
                ],
            ],
        ], compact('query')))->toArray();
    }
}
