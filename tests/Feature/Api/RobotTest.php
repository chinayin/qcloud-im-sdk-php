<?php

namespace QcloudIM\Tests\Feature\Api;

use QcloudIM\Api\Profile;
use QcloudIM\Tests\TestCase;

class RobotTest extends TestCase
{
    /**
     * @var Profile
     */
    protected $robot;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->robot = $this->app->get('Robot');
    }


    public function testChecksIfUserIdStartsWithRBT()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('UserId must start with @RBT#.');

        $this->robot->createRobot('invalidUserId', 'nick', 'faceUrl');
    }

    public function testThrowsExceptionWhenUserIdIsEmpty()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid Params UserId.');

        $this->robot->createRobot('', 'nick', 'faceUrl');
    }

    public function testCreatesRobotSuccessfully()
    {
        $response = $this->robot->createRobot('@RBT#userId', 'nick', 'faceUrl');

        $this->assertTrue($response);
    }


}
