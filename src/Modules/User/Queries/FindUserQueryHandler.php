<?php

namespace Modules\User\Queries;

use App\Bus\QueryHandler;
use Modules\User\Repositories\ReadUserRepository;

class FindUserQueryHandler extends QueryHandler
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
