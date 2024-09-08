<?php

declare(strict_types=1);

namespace As984\PhpAttributes\Attributes\Validation;

use As984\PhpAttributes\Contracts\ValidatorInterface;

class EmailValidator implements ValidatorInterface
{
    const Message = "The property '%s' must be a valid email address";

    public function validate($value): bool
    {
        // Check if the value is a valid email
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

}