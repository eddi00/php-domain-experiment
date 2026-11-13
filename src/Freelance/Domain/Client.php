<?php

namespace App\Freelance\Domain;

final class Client
{
    private function __construct(
        private Email $email,
    ) {}

    public static function register(Email $email): self
    {
        return new self($email);
    }
}