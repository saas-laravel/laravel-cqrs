<?php

namespace Modules\User\Commands;

use App\Bus\CommandHandler;
use Modules\User\Repositories\WriteUserRepository;

class CreateUserCommandHandler extends CommandHandler
{
    public function __construct(
        protected WriteUserRepository $repository,
    ) {
    }

    public function handle(CreateUserCommand $command): int
    {
        return $this->repository->create(
            name: $command->getName(),
            email: $command->getEmail(),
        );
    }

}
