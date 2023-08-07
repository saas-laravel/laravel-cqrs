<?php

namespace Modules\User\Queries;

use App\Bus\Query;
use Modules\User\Repositories\ReadUserRepository;

class FindUserQueryHandler extends Query
{

    public function __construct(
        protected readonly ReadUserRepository $repository,
    ) {}

    public function handle(FindUserQuery $query): ?object
    {
        return $this->repository->find(
            $query->getId(),
        );
    }

}
