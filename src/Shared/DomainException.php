<?php

declare(strict_types=1);

namespace App\Shared;

use DomainException;

abstract class DomainError extends DomainException
{
    public function __construct()
    {
        parent::__construct($this->errorMessage(), $this->errorCode());
    }

    abstract public function errorCodeMessage(): string;

    abstract protected function errorMessage(): string;
}
