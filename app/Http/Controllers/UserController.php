<?php

namespace App\Http\Controllers;

use App\Bus\QueryBus;
use App\Bus\CommandBus;
use Illuminate\Http\Request;
use Modules\User\ValueObjects\Email;
use Modules\User\Queries\FindUserQuery;
use Modules\FeatureFlag\Enums\FeatureFlag;
use Modules\User\Commands\CreateUserCommand;
use Modules\FeatureFlag\Services\FeatureFlagService;

class UserController
{

    public function __construct(
        protected CommandBus $commandBus,
        protected QueryBus $queryBus,
        protected FeatureFlagService $service,
    ) {
    }

    public function __invoke(Request $request)
    {
        if (! $this->service->for($request->user())->isEnabled(FeatureFlag::NewChat)) {
            throw new \Exception("");
        }

        $id = $this->commandBus->dispatch(
            new CreateUserCommand(
                name: fake()->name,
                email: Email::from(fake()->email()),
            ),
        );

        $user = $this->queryBus->ask(
            new FindUserQuery($id)
        );

        return $user;
    }

}
