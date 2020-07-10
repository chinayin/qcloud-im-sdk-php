<?php

namespace QcloudIM\Tests\Feature\Api;

use QcloudIM\Constants;
use QcloudIM\Model\ProfileItem;
use QcloudIM\Tests\TestCase;

class ProfileTest extends TestCase
{
    /**
     * @var Profile
     */
    protected $profile;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->profile = $this->app->get('Profile');
    }

    public function testGet()
    {
        $r = $this->profile->get('CUST_63518', Constants::TAG_PROFILE_IM_ALL);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testBatchGet()
    {
        $r = $this->profile->batchGet(['CUST_63518', 'abcd'], [
            Constants::TAG_PROFILE_IM_NICK, Constants::TAG_PROFILE_IM_IMAGE
        ]);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

    public function testSet()
    {
        $data = [
            new ProfileItem(Constants::TAG_PROFILE_IM_NICK, '田一巴'),
            new ProfileItem(Constants::TAG_PROFILE_IM_LANGUAGE, 123),
        ];
        $r = $this->profile->set('CUST_63518', $data);
        var_dump($r);
        $r = $this->profile->get('CUST_63518', [Constants::TAG_PROFILE_IM_NICK, Constants::TAG_PROFILE_IM_LANGUAGE]);
        var_dump($r);
        $this->assertNotEmpty($r);
    }

}
