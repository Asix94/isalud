<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Adapter;

use App\Shared\Domain\Guzzle\HttpMethod;
use App\Shared\Domain\Guzzle\RequestOptions;
use App\Shared\Domain\Guzzle\Response;
use App\Shared\Domain\Guzzle\Uri;
use App\Shared\Utils;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

abstract class GuzzleAdapter
{
    public function __construct(private readonly Client $client)
    {
    }

    public function doCall(HttpMethod $method, Uri $uri, ?RequestOptions $options): Response
    {
        $response = $this->getResponse($method, $uri, $options);

        return new Response($response->getHeaders(), Utils::jsonDecode($response->getBody()->getContents()));
    }

    private function getResponse(HttpMethod $method, Uri $uri, ?RequestOptions $options): ResponseInterface
    {
        return $this->client->request($method->value, $uri->value(), $options ? $options->value() : []);
    }

    public function doCallNonJson(HttpMethod $method, Uri $uri, ?RequestOptions $options): Response
    {
        $response = $this->getResponse($method, $uri, $options);

        return new Response($response->getHeaders(), $response->getBody()->getContents());
    }
}
