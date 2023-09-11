<?php

namespace Core\Exceptions;

enum ExceptionCode: int
{
    case NoSubscription = 10_000;
    case LimitExceeded = 10_001;

    case UserAlreadyExists = 11_000;
    case AiGenerationError = 12_000;

    case NoAccess = 90_000;

    public function getStatusCode(): int
    {
        $value = $this->value;

        return match(true) {
            $value >= 90_000 => 403,
            $value >= 10_000 => 400,
            default => 500,
        };
    }

    public function getMessage(): string
    {
        $key = "exceptions.{$this->value}.message";
        $translation = __($key);

        if ($key === $translation) {
            return "Something went wrong";
        }

        return $translation;
    }

    public function getDescription(): string
    {
        $key = "exceptions.{$this->value}.description";
        $translation = __($key);

        if ($key === $translation) {
            return "No additional description provided";
        }

        return $translation;
    }

    public function getLink(): string
    {
        return route('docs.exceptions', [
            'code' => $this->value,
        ]);
    }
}
