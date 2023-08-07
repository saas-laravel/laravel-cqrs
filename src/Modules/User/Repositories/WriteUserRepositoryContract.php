<?php

namespace Modules\User\Repositories;

use Modules\User\ValueObjects\Email;

interface WriteUserRepositoryContract
{

    public function create(string $name, Email $email): int;

}
