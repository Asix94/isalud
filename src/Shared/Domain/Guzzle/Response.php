<?php

declare(strict_types=1);

namespace App\Shared\Domain\Guzzle;

final class Response
{
    public function __construct(private array $headers, private mixed $content)
    {
    }

    public function headers(): array
    {
        return $this->headers;
    }

    public function value(): array
    {
        return (array) $this->content;
    }

    public function content(): mixed
    {
        return $this->content;
    }
}
