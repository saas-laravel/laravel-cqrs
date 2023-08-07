<?php

namespace App\Bus;

interface QueryBus
{

    public function ask(Query $query): mixed;

    public function register(array $map): void;

}
