<?php

namespace Modules\User\Repositories;

interface ReadUserRepositoryContract
{

    public function find(int $id): ?object;

}
