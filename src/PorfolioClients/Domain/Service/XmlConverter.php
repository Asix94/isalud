<?php

declare(strict_types=1);

namespace App\PorfolioClients\Domain\Service;

use App\PorfolioClients\Domain\Customer;
use App\PorfolioClients\Domain\Customers;

class XmlConverter
{
    public function __invoke(string $xml): Customers
    {
        $xmldata = simplexml_load_string(file_get_contents($xml)) or die("Failed to load");

        foreach ($xmldata->children() as $reading) {
            $customers[] = Customer::create(
                $reading->attributes()->name . '',
                $reading . '',
                $reading->attributes()->phone . '',
                $reading->attributes()->company . ''
            );
        }

        return Customers::create($customers);
    }
}
