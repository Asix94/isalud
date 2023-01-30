<?php

declare(strict_types=1);

namespace App\Tests\PorfolioClients\Application;

use App\PorfolioClients\Application\CustomerCsvCreator;
use App\PorfolioClients\Domain\Customer;
use App\PorfolioClients\Domain\Customers;
use App\PorfolioClients\Domain\Service\GetCustomers;
use App\PorfolioClients\Domain\Service\XmlConverter;
use PHPUnit\Framework\TestCase;

final class CustomerCsvCreatorTest extends TestCase
{
    public const FILENAME = 'testFile.csv';

    public function tearDown(): void
    {
        if (file_exists(self::FILENAME) === true) {
            unlink(self::FILENAME);
        }
    }
    /**
     * @covers CustomerCsvCreatorTest
     */
    public function testCsvFileCreation()
    {
        $xml = 'data.xml';
        $getCustomers = $this->createMock(GetCustomers::class);
        $xmlConverter = $this->createMock(XmlConverter::class);

        $jsonCustomers = Customers::create(
          [Customer::create('John Doe', 'johndoe@example.com', '555-555-5555', 'ACME')]
        );

        $xmlCustomers = Customers::create(
            [Customer::create('John Doe 2', 'johndoe2@example.com', '222-222-222', 'ACME2')]
        );

        $getCustomers->expects($this->once())->method('__invoke')->willReturn($jsonCustomers);
        $xmlConverter->expects($this->once())->method('__invoke')->willReturn($xmlCustomers);

        $customerCsvCreator = new CustomerCsvCreator($getCustomers, $xmlConverter);
        $customerCsvCreator->__invoke(self::FILENAME, $xml);

        $this->assertFileExists(self::FILENAME);
    }
}
