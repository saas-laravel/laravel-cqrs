<?php

namespace Modules\User\Repositories;

use Illuminate\Support\Facades\DB;

class ReadUserRepository implements ReadUserRepositoryContract
{

    public function find(int $id): ?object
    {
        return DB::table('users')->where('id', $id)->first();
    }
}
