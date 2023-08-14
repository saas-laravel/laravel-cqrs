<?php

namespace Modules\FeatureFlag\Contracts;

use Modules\FeatureFlag\Enums\FeatureFlag;

interface FeatureFlagClientInterface
{

    public function withAttributes(array $attributes): self;

    public function isOn(FeatureFlag $flag): bool;

    public function getFeatures(): array;

}
