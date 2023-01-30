<?php

declare(strict_types=1);

namespace App\PorfolioClients\Domain;

use App\Shared\Domain\Collection;

final class Customers extends Collection
{
    public static function create(array $customers): Customers
    {
        return new self($customers);
    }

    protected function type(): string
    {
        return Customer::class;
    }
}
