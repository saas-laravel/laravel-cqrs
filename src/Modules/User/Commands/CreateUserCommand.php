<?php

namespace Modules\User\Commands;

use App\Bus\Command;
use Modules\User\ValueObjects\Email;

class CreateUserCommand extends Command
{

    public function __construct(
        private readonly string $name,
        private readonly Email $email,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

}
