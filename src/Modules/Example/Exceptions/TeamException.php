<?php

namespace Modules\Example\Exceptions;

use Core\Exceptions\ExceptionCode;
use Core\Exceptions\InternalException;

class TeamException extends InternalException
{
    public static function limitExceeded(): self
    {
        return static::new(
            ExceptionCode::LimitExceeded,
            'Team limit exceeded',
            'You have reached the limit of teams you can create.',
        );
    }

}
