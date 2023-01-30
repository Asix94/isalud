<?php

declare(strict_types=1);

namespace App\Shared\Domain\Guzzle\Exception;

use App\Shared\DomainError;
use Symfony\Component\HttpFoundation\Response;
use App\Shared\Domain\Guzzle\Uri;

final class UriNotValid extends DomainError
{
    public function __construct(private Uri $uri)
    {
        parent::__construct();
    }

    public function errorCodeMessage(): string
    {
        return 'guzzle_url_is_not_valid';
    }

    protected function errorMessage(): string
    {
        return sprintf('Guzzle URL <%s> is not valid', $this->uri->value());
    }

    public function errorCode(): int
    {
        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}
