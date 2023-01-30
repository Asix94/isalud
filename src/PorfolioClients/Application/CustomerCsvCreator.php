<?php


declare(strict_types=1);

namespace App\PorfolioClients\Application;

use App\PorfolioClients\Domain\Customer;
use App\PorfolioClients\Domain\Service\GetCustomers;
use App\PorfolioClients\Domain\Service\XmlConverter;

use function Lambdish\Phunctional\map;

final class CustomerCsvCreator
{
    public function __construct(
        private readonly GetCustomers $getCustomers,
        private readonly XmlConverter $xmlConverter
    ) {
    }

    public function __invoke(string $filename, ?string $xml): void
    {
        $customers = $this->getCustomers->__invoke();

        if ($xml) {
            $xmlCustomers = $this->xmlConverter->__invoke($xml);
            $customers = array_merge(
                $customers->getIterator()->getArrayCopy(),
                $xmlCustomers->getIterator()->getArrayCopy()
            );
        }

        $fp = fopen($filename, 'wb');

        fputcsv($fp, ['name', 'email', 'phone', 'companyName']);

        map(static function (Customer $customer) use ($fp) {
            fputcsv($fp, [
                'name' => $customer->name(),
                'email' => $customer->email(),
                'phone' => $customer->phone(),
                'companyName' => $customer->companyName()
            ]);
        }, $customers);

        fclose($fp);
    }
}
