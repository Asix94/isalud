<?php


declare(strict_types=1);

namespace App\PorfolioClients\Domain;

interface CustomerRepository
{
    public function getAll(): Customers;
}
