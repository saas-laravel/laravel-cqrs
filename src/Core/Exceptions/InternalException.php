<?php

namespace Core\Exceptions;

use Exception;

class InternalException extends Exception
{
    protected string $description;
    protected ExceptionCode $internalCode;

    public static function new(
        ExceptionCode $code,
        ?string $message = null,
        ?string $description = null,
        ?int $statusCode = null,
    ): static
    {
        $exception = new static(
            $message ?? $code->getMessage(),
            $statusCode ?? $code->getStatusCode(),
        );

        $exception->internalCode = $code;
        $exception->description = $description ?? $code->getDescription();

        return $exception;
    }

    public function getInternalCode(): ExceptionCode
    {
        return $this->internalCode;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
