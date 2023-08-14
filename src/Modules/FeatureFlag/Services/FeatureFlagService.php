<?php

namespace Modules\FeatureFlag\Services;

use App\Models\User;
use Modules\FeatureFlag\Enums\FeatureFlag;
use Modules\FeatureFlag\Contracts\FeatureFlagClientInterface;

class FeatureFlagService
{
    protected FeatureFlagClientInterface $client;

    public function __construct(User $user)
    {
        $this->client = app(FeatureFlagClientInterface::class)
            ->withAttributes([
                'id' => $user->id,
            ]);
    }

    public static function for(User $user): self
    {
        return new self($user);
    }

    public function isEnabled(FeatureFlag $flag): bool
    {
        return $this->client->isOn($flag);
    }

}
