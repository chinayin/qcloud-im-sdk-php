<?php

namespace QcloudIM\Tests;

use QcloudIM\App;
use ReflectionClass;

class TestCase extends \PHPUnit\Framework\TestCase
{

    public $app;

    protected function setUp(): void
    {
        parent::setUp();
        $this->app = new App([
            'sdkappid' => getenv('SDK_APPID'),
            'secret' => getenv('SDK_SECRET'),
            'identifier' => getenv('SDK_IDENTIFIER'),
            'cache' => [
                'path' => __DIR__ . '/runtime/cache',
            ],
            'log' => [
                'file' => __DIR__ . '/runtime/log/app.log',
                'level' => 'debug',
            ],
        ]);
    }

    /**
     * @param object $object
     * @param string $name
     * @param array  $args
     *
     * @return \ReflectionMethod
     * @throws \ReflectionException
     */
    protected function callMethod($object, string $name, array $args = [])
    {
        $class = new ReflectionClass($object);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $args);
    }

    /**
     *
     */
    protected function tearDown(): void
    {
        parent::tearDown();
//        \Mockery::close();
    }
}
