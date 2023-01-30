<?php


declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

abstract class ArrayValueObject
{
    public function __construct(protected array $value)
    {
    }

    public function value(): array
    {
        return $this->value;
    }
}
