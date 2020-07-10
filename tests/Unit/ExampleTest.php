<?php

namespace QcloudIM\Tests\Unit;

/**
 * @internal
 * @coversNothing
 */
final class ExampleTest extends \PHPUnit\Framework\TestCase
{

    public function test()
    {
        $this->assertSame(
            'user@example.com',
            strtolower('user@example.com')
        );
    }
}
