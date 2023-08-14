<?php

namespace Modules\FeatureFlag\Clients;

use Growthbook\Growthbook;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Modules\FeatureFlag\Enums\FeatureFlag;
use Modules\FeatureFlag\Contracts\FeatureFlagClientInterface;

class GrowthbookFeatureFlagClient implements FeatureFlagClientInterface
{
    protected Growthbook $growthbook;

    public function __construct()
    {
        $this->growthbook = Growthbook::create()
            ->withFeatures(
                $this->getFeatures()
            );
    }


    public function withAttributes(array $attributes): FeatureFlagClientInterface
    {
        $this->growthbook->withAttributes($attributes);

        return $this;
    }

    public function isOn(FeatureFlag $flag): bool
    {
        return $this->growthbook->isOn($flag->value);
    }

    public function getFeatures(): array
    {
        return Cache::remember('feature_flags', now()->addMinutes(15), function () {
            return Http::asJson()
                ->get('https://cdn.growthbook.io/api/features/' . config('services.growthbook.api_key'))
                ->json()['features'] ?? [];
        });
    }
}
