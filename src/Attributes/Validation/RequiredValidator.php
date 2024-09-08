<?php

declare(strict_types=1);

namespace As984\PhpAttributes\Attributes\Validation;

use As984\PhpAttributes\Contracts\ValidatorInterface;

class RequiredValidator implements ValidatorInterface
{
    const Message = "The Property '%s' Must Be Required";

    public function validate($value): bool
    {
        return !empty($value);
    }


}