<?php

namespace Modules\User\Queries;

use App\Bus\Query;

class FindUserQuery extends Query
{

    public function __construct(
        private readonly int $id,
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

}
