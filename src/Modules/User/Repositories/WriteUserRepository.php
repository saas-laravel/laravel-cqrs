<?php

namespace Modules\User\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\User\ValueObjects\Email;

class WriteUserRepository implements WriteUserRepositoryContract
{

    public function create(string $name, Email $email): int
    {
        return DB::table('users')->insertGetId([
            'name' => $name,
            'email' => $email->toNative(),
            'password' => '12345678',
        ]);
    }
}
