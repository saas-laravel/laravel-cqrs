<?php

namespace Tests;

use Mockery\MockInterface;
use Modules\FeatureFlag\Enums\FeatureFlag;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Modules\FeatureFlag\Contracts\FeatureFlagClientInterface;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function withFeatureFlag(FeatureFlag $flag, bool $enabled): self
    {
        $this->instance(
            FeatureFlagClientInterface::class,
            \Mockery::mock(FeatureFlagClientInterface::class, function (MockInterface $mock) use ($enabled, $flag) {
                $mock->shouldReceive('withAttributes')->andReturnSelf();

                $mock->shouldReceive('isOn')
                    ->with($flag)
                    ->andReturn($enabled);
            })
        );

        return $this;
    }

    protected function withFlagEnabled(FeatureFlag $flag): self
    {
        return $this->withFeatureFlag($flag, true);
    }

    protected function withoutFlagEnabled(FeatureFlag $flag): self
    {
        return $this->withFeatureFlag($flag, false);
    }
}
