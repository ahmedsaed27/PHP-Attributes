<?php

declare(strict_types=1);

namespace As984\PhpAttributes\Attributes\Validation\Rules;

use As984\PhpAttributes\Attributes\Validation\EmailValidator;
use As984\PhpAttributes\Contracts\ValidationRuleInterface;
use As984\PhpAttributes\Contracts\ValidatorInterface;
use Attribute;

#[Attribute]
class Email implements ValidationRuleInterface
{
    public function getValidator(): ValidatorInterface
    {
        return new EmailValidator();
    }
}