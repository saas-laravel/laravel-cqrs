<?php

namespace Core\Exceptions;

enum ExceptionCode: int
{
    /** 10_*** - billing errors */
    case LimitExceeded = 10_000;

    /** 90_*** - access errors */


    public function getStatusCode(): int
    {
        $value = $this->value;

        return match (true) {
            $value >= 90_000 => 403,
            $value >= 10_000 => 400,
            default => 500,
        };
    }

    public function getDescription(): string
    {
        return __('exceptions.' . $this->value . '.description');
    }

    public function getLink(): string
    {
        return route('docs.exceptions', [
            'code' => $this->value,
        ]);
    }

    public function getMessage(): string
    {
        return __('exceptions.' . $this->value . '.message');
    }
}
