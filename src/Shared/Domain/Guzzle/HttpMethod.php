<?php

declare(strict_types=1);

namespace App\Shared\Domain\Guzzle;

enum HttpMethod: string
{
    case GET = 'GET';
    case POST = 'POST';
    case PATCH = 'PATCH';
}
