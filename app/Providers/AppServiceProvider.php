<?php

namespace App\Providers;

use App\Bus\QueryBus;
use App\Bus\CommandBus;
use App\Bus\IlluminateQueryBus;
use Modules\Ai\Client\AiClient;
use App\Bus\IlluminateCommandBus;
use Modules\Ai\Client\OpenAiClient;
use Illuminate\Support\ServiceProvider;
use Modules\User\Queries\FindUserQuery;
use Modules\User\Commands\CreateUserCommand;
use Modules\User\Queries\FindUserQueryHandler;
use Modules\User\Repositories\ReadUserRepository;
use Modules\User\Repositories\WriteUserRepository;
use Modules\User\Commands\CreateUserCommandHandler;
use Modules\User\Repositories\ReadUserRepositoryContract;
use Modules\User\Repositories\WriteUserRepositoryContract;
use Modules\FeatureFlag\Clients\GrowthbookFeatureFlagClient;
use Modules\FeatureFlag\Contracts\FeatureFlagClientInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $singletons = [
            CommandBus::class => IlluminateCommandBus::class,
            QueryBus::class => IlluminateQueryBus::class,

            WriteUserRepositoryContract::class => WriteUserRepository::class,
            ReadUserRepositoryContract::class => ReadUserRepository::class,

            AiClient::class => OpenAiClient::class,
        ];

        foreach ($singletons as $abstract => $concrete) {
            $this->app->singleton(
                $abstract,
                $concrete,
            );
        }

        $this->app->bind(
            FeatureFlagClientInterface::class,
            GrowthbookFeatureFlagClient::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $commandBus = app(CommandBus::class);

        $commandBus->register([
            CreateUserCommand::class => CreateUserCommandHandler::class,
        ]);

        $queryBus = app(QueryBus::class);

        $queryBus->register([
            FindUserQuery::class => FindUserQueryHandler::class,
        ]);
    }
}
