<?php

declare(strict_types=1);

namespace App\PorfolioClients\Infrastructure;

use App\PorfolioClients\Domain\Customer;
use App\PorfolioClients\Domain\CustomerRepository;
use App\PorfolioClients\Domain\Customers;
use App\PorfolioClients\Domain\Exeption\CustomersNotFound;
use App\Shared\Domain\Guzzle\HttpMethod;
use App\Shared\Domain\Guzzle\Uri;
use App\Shared\Infrastructure\Adapter\GuzzleAdapter;
use GuzzleHttp\Exception\ClientException;
use Symfony\Component\HttpFoundation\Response;

use function Lambdish\Phunctional\map;

final class CustomerApiRepository extends GuzzleAdapter implements CustomerRepository
{
    public function getAll(): Customers
    {
        try {
            $response = $this->doCall(
                HttpMethod::tryFrom('GET'),
                new Uri('https://jsonplaceholder.typicode.com/users'),
                null
            );
        } catch (ClientException $e) {
            $response = $e->getResponse();
            if ($response->getStatusCode() === Response::HTTP_NOT_FOUND) {
                throw new CustomersNotFound();
            }
        }

        return Customers::create(
            map(static function (array $customer) {
                return Customer::create(
                    $customer['name'],
                    $customer['email'],
                    $customer['phone'],
                    $customer['company']['name']
                );
            }, $response->content())
        );
    }
}
