<?php

namespace App\Http\Controllers;

use App\Bus\QueryBus;
use App\Bus\CommandBus;
use Modules\User\ValueObjects\Email;
use Modules\User\Queries\FindUserQuery;
use Modules\User\Commands\CreateUserCommand;

class UserController
{

    public function __construct(
        protected CommandBus $commandBus,
        protected QueryBus $queryBus,
    ) {}

    public function __invoke()
    {
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
