<?php

declare(strict_types=1);

namespace App\PorfolioClients\Domain;

final class Customer
{
    public function __construct(
        private readonly string $name,
        private readonly string $email,
        private readonly string $phone,
        private readonly string $companyName
    ) {
    }

    public static function create(string $name, string $email, string $phone, string $companyName): self
    {
        return new self($name, $email, $phone, $companyName);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function phone(): string
    {
        return $this->phone;
    }

    public function companyName(): string
    {
        return $this->companyName;
    }
}
