<?php

declare(strict_types=1);

namespace App\Tests\PorfolioClients\Domain\Service;

use App\PorfolioClients\Domain\Customer;
use App\PorfolioClients\Domain\CustomerRepository;
use App\PorfolioClients\Domain\Customers;
use App\PorfolioClients\Domain\Service\GetCustomers;
use PHPUnit\Framework\TestCase;

final class GetCustomersTest extends TestCase
{
    /**
     * @covers GetCustomersTest
     */
    public function testGetCustomiser(): void
    {
        $repository = $this->createMock(CustomerRepository::class);
        $jsonCustomers = Customers::create(
            [Customer::create('John Doe', 'johndoe@example.com', '555-555-5555', 'ACME')]
        );

        $repository->expects($this->once())->method('getAll')->willReturn($jsonCustomers);

        $getCustomers = new GetCustomers($repository);
        $customers = $getCustomers->__invoke();

        self::assertEquals($customers, $jsonCustomers);
    }
}
