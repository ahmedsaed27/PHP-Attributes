<?php

declare(strict_types=1);

namespace As984\PhpAttributes\Contracts;

interface ValidatorInterface
{
    public function validate($value): bool;
}