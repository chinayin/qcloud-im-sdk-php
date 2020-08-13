<?php

namespace QcloudIM\Http;

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use QcloudIM\Cache\Token;
use QcloudIM\Constants;

class Middleware
{
    /**
     * @return callable
     */
    public static function useragent()
    {
        return \GuzzleHttp\Middleware::mapRequest(function (RequestInterface $request) {
            return $request->withHeader('User-Agent', sprintf('QcloudIMSdk (%s %s; %s)) Client/%s PHP/%s',
                \PHP_OS, php_uname('r'), php_uname('m')
                , Constants::SDK_VERSION, \PHP_VERSION));
        });
    }

    /**
     * @param Token $token
     *
     * @return callable
     */
    public static function auth(Token $token)
    {
        return \GuzzleHttp\Middleware::mapRequest(function (RequestInterface $request) use ($token) {
            return $request->withUri(Uri::withQueryValues($request->getUri(), [
                'sdkappid' => $token->getSdkAppId(),
                'identifier' => $token->getIdentifier(),
                'usersig' => $token->get(),
                'random' => rand(1, 999999),
                'contenttype' => 'json',
            ]));
        });
    }

    /**
     * @param LoggerInterface $logger
     *
     * @return callable
     */
    public static function log(LoggerInterface $logger)
    {
        return \GuzzleHttp\Middleware::log($logger,
            new MessageFormatter(MessageFormatter::DEBUG),
            LogLevel::DEBUG);
    }

    /**
     * @param LoggerInterface $logger
     *
     * @return callable
     */
    public static function retry(LoggerInterface $logger)
    {
        return \GuzzleHttp\Middleware::retry(function (
            $retries,
            Request $request,
            Response $response = null,
            RequestException $exception = null
        ) use ($logger) {
            if ($retries >= Constants::SDK_RETRY_MAX_RETRIES) {
                return false;
            }
            if (
                ($exception instanceof ConnectException)
                or ($response && $response->getStatusCode() >= 500)
            ) {
                $logger->warning(sprintf(
                    'Retrying %s %s %s/%s, %s',
                    $request->getMethod(),
                    $request->getUri(),
                    $retries + 1,
                    Constants::SDK_RETRY_MAX_RETRIES,
                    $response ? 'status code: ' . $response->getStatusCode() : $exception->getMessage()
                ), [
                    $request->getHeader('Host')[0]
                ]);
                return true;
            }
            return false;
        });
    }

    /**
     * @return callable
     */
    public static function response()
    {
        return \GuzzleHttp\Middleware::mapResponse(function (ResponseInterface $response) {
            return new Response(
                $response->getStatusCode(),
                $response->getHeaders(),
                $response->getBody(),
                $response->getProtocolVersion(),
                $response->getReasonPhrase()
            );
        });
    }

}
