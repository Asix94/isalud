<?php


declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

abstract class StringValueObject
{
    public function __construct(protected string $value)
    {
    }

    public function value(): string
    {
        return $this->value;
    }

    public function htmlSpecialCharsDecode(): string
    {
        return htmlspecialchars_decode($this->value);
    }
}
