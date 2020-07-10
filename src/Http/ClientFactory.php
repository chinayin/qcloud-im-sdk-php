<?php

namespace QcloudIM\Http;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Psr\Log\LoggerInterface;
use QcloudIM\Cache\Token;
use QcloudIM\Constants;

class ClientFactory
{
    /**
     * @param LoggerInterface $logger
     * @param Token           $token
     *
     * @return Client
     */
    public static function create(LoggerInterface $logger, $token = null)
    {
        $stack = HandlerStack::create();

        $stack->push(Middleware::log($logger));
        $stack->push(Middleware::useragent());
        $stack->push(Middleware::retry($logger));
        $stack->push(Middleware::response());

        if ($token instanceof Token) {
            $stack->push(Middleware::auth($token));
        }

        return new Client([
            'base_uri' => Constants::SDK_BASE_URI,
            'handler' => $stack
        ]);
    }
}
