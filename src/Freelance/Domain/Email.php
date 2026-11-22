<?php

declare(strict_types=1);

namespace App\Freelance\Domain;

final class Email
{
    private function __construct(
        private string $email,
    ) {}

    public static function fromString(string $email): self
    {
        return new self($email);
    }

    public function toString(): string
    {
        return $this->email;
    }
}