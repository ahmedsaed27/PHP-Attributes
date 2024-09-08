<?php

declare(strict_types=1);

namespace As984\PhpAttributes\DTO;

use As984\PhpAttributes\Attributes\Validation\Rules\Email;
use As984\PhpAttributes\Attributes\Validation\Rules\Required;

final readonly class UserRegistration
{

    public function __construct(
        #[Required]
        public string $username,
        #[Required , Email]
        public string $email,
        #[Required]
        public string $phone,
    )
    {
        
    }
    
}