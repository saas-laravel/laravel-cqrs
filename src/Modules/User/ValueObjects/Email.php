<?php

namespace Modules\User\ValueObjects;


use InvalidArgumentException;

class Email
{

    public function __construct(protected string $email)
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email address provided");
        }
    }

    public static function from(string $email): Email
    {
        return new self($email);
    }

    public function toNative(): string
    {
        return $this->email;
    }
}
