<?php

namespace QcloudIM;

use Doctrine\Common\Collections\ArrayCollection;
use GuzzleHttp\Client;
use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use QcloudIM\Api\Account;
use QcloudIM\Api\ChatMessage;
use QcloudIM\Api\Friend;
use QcloudIM\Api\FriendBlacklist;
use QcloudIM\Api\GlobalConfig;
use QcloudIM\Api\Group;
use QcloudIM\Api\GroupMessage;
use QcloudIM\Api\ImportGroup;
use QcloudIM\Api\Profile;
use QcloudIM\Cache\Token;
use QcloudIM\Http\ClientFactory;
use QcloudIM\Http\HttpClient;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class App extends ContainerBuilder
{
    /**
     * @var ArrayCollection
     */
    private $config;

    /**
     * @var array
     */
    private $apiServices = [
        'Account' => Account::class,
        'Profile' => Profile::class,
        'Friend' => Friend::class,
        'FriendBlacklist' => FriendBlacklist::class,
        'Group' => Group::class,
        'GroupMessage' => GroupMessage::class,
        'ChatMessage' => ChatMessage::class,
        'ImportGroup' => ImportGroup::class,
        'GlobalConfig' => GlobalConfig::class,
    ];

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        parent::__construct();
        $this->config = new ArrayCollection($config);
        $this->registerServices();
    }

    /**
     * @return void
     */
    private function registerServices(): void
    {
        $this->registerLogger();
        $this->registerHttpClient();
        $this->registerCache();
        $this->registerToken();
        $this->registerHttpClientWithToken();
        foreach ($this->apiServices as $id => $class) {
            $this->registerApi($id, $class);
        }
    }

    /**
     * @return void
     */
    private function registerLogger(): void
    {
        $log = $this->config->get('log');
        if (is_subclass_of($log, LoggerInterface::class)) {
            $this->register('logger', $log);
        } elseif ($log) {
            $this->register('logger_handler', StreamHandler::class)
                ->setArguments([$log['file'], isset($log['level']) ? $log['level'] : 'debug']);
            $this->registerMonolog();
        } else {
            $this->register('logger_handler', NullHandler::class);
            $this->registerMonolog();
        }
    }

    /**
     * @return void
     */
    private function registerMonolog(): void
    {
        $this->register('logger', Logger::class)
            ->addArgument('QcloudIM')
            ->addMethodCall('setTimezone', [new \DateTimeZone('PRC')])
            ->addMethodCall('pushHandler', [new Reference('logger_handler')]);
    }

    /**
     * @return void
     */
    private function registerHttpClient(): void
    {
        $this->register('client', Client::class)
            ->addArgument(new Reference('logger'))
            ->setFactory([ClientFactory::class, 'create']);
        $this->register('http_client', HttpClient::class)
            ->addArgument(new Reference('client'));
    }

    /**
     * @return void
     */
    private function registerHttpClientWithToken(): void
    {
        $this->register('client_with_token', Client::class)
            ->setArguments([new Reference('logger'), new Reference('token')])
            ->setFactory([ClientFactory::class, 'create']);
        $this->register('http_client_with_token', HttpClient::class)
            ->addArgument(new Reference('client_with_token'));
    }

    /**
     * @return void
     */
    private function registerCache(): void
    {
        $cache = $this->config->get('cache');
        if (is_subclass_of($cache, CacheItemPoolInterface::class)) {
            $this->register('cache', $cache);
        } else {
            $service = $this->register('cache', FilesystemAdapter::class);
            if ($cache && isset($cache['path'])) {
                $service->setArguments(['', 0, $cache['path']]);
            }
        }
    }

    /**
     * @return void
     */
    private function registerToken(): void
    {
        $this->register('token', Token::class)
            ->addMethodCall('setSdkAppId', [$this->config->get('sdkappid')])
            ->addMethodCall('setSecret', [$this->config->get('secret')])
            ->addMethodCall('setIdentifier', [$this->config->get('identifier')])
            ->addMethodCall('setCache', [new Reference('cache')])
            ->addMethodCall('setHttpClient', [new Reference('http_client')]);
    }

    /**
     * @param string $id
     * @param string $class
     *
     * @return void
     */
    private function registerApi(string $id, string $class): void
    {
        $api = $this->register($id, $class)
            ->addMethodCall('setHttpClient', [new Reference('http_client_with_token')]);
    }

}
