<?php

declare(strict_types=1);

namespace App\Shared\Domain\Guzzle;

use App\Shared\Domain\Guzzle\Exception\UriNotValid;
use App\Shared\Domain\ValueObject\StringValueObject;

final class Uri extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->value = $value;
        $this->ensureIsValid();
    }

    private function ensureIsValid(): void
    {
        if (filter_var($this->value, FILTER_VALIDATE_URL) === false) {
            throw new UriNotValid($this);
        }
    }
}
