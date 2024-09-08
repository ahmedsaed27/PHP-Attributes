<?php

declare(strict_types=1);

namespace As984\PhpAttributes\Contracts;

interface ValidationRuleInterface
{
    public function getValidator(): ValidatorInterface;
}