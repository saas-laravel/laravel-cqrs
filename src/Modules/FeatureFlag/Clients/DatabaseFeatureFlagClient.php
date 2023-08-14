<?php

namespace Modules\FeatureFlag\Clients;

use Modules\FeatureFlag\Enums\FeatureFlag;
use Modules\FeatureFlag\Contracts\FeatureFlagClientInterface;

class DatabaseFeatureFlagClient implements FeatureFlagClientInterface
{

    protected array $attributes = [];

    public function withAttributes(array $attributes): FeatureFlagClientInterface
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function isOn(FeatureFlag $flag): bool
    {
        $flag = \DB::table('feature_flags')->where('name', $flag->value)->first();

        foreach ($flag->conditions as $condition) {
            if (! $condition->matches($this->attributes[$condition->attribute])) {
                return false;
            }
        }

        return true;
    }

    public function getFeatures(): array
    {
        return FeatureFlag::cases();
    }
}
