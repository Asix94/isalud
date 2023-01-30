<?php

declare(strict_types=1);

namespace App\PorfolioClients\Domain\Exeption;

use App\Shared\DomainError;

final class CustomersNotFound extends DomainError
{
    protected function errorMessage(): string
    {
        return 'customers not found';
    }

    public function errorCodeMessage(): string
    {
        return 'customers_not_found';
    }
}
