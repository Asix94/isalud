<?php

declare(strict_types=1);

namespace App\PorfolioClients\Domain\Service;

use App\PorfolioClients\Domain\CustomerRepository;
use App\PorfolioClients\Domain\Customers;

class GetCustomers
{
    public function __construct(private readonly CustomerRepository $repository)
    {
    }

    public function __invoke(): Customers
    {
        return $this->repository->getAll();
    }
}
