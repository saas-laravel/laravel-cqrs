<?php

namespace Modules\Ai\Exceptions;

use Core\Exceptions\ExceptionCode;
use Core\Exceptions\InternalException;

class AiException extends InternalException
{

    public static function unknownError(): self
    {
        return static::new(
            ExceptionCode::AiGenerationError,
        );
    }

}
