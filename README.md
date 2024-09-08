# PHP Attributes Validation Library

## Overview

This PHP Attributes Validation Library provides a mechanism for validating object properties using attributes. The library uses custom validation rules defined as attributes and integrates them with a validator to check the object's properties.

## Installation

1. Clone the repository or download the code.
2. Run `composer install` to install the required dependencies.

## Usage

### Example

Here's a simple example of how to use the library to validate a user registration object:

```php
<?php

use As984\PhpAttributes\Attributes\Validation\Validator;
use As984\PhpAttributes\DTO\UserRegistration;

require_once './vendor/autoload.php';

// Create a new UserRegistration instance
$userRegistration = new UserRegistration(username: '', email: '', phone: '');

// Create a Validator instance
$validator = new Validator();

// Validate the UserRegistration object
$errors = $validator->validate($userRegistration);

// Output validation errors
dd($errors);

```

### Components
UserRegistration Class
Defines the data transfer object (DTO) for user registration with the following properties:

- username (required)
- email (required and must be a valid email)
- phone (required)

```php
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
        #[Required, Email]
        public string $email,
        #[Required]
        public string $phone,
    )
    {
    }
}
```


### Validator Class
The Validator class uses reflection to apply validation rules defined by attributes on the properties of an object.


```php
<?php

declare(strict_types=1);

namespace As984\PhpAttributes\Attributes\Validation;

use As984\PhpAttributes\Contracts\ValidationRuleInterface;
use ReflectionAttribute;
use ReflectionClass;

class Validator
{
    private array $errors = [];

    public function validate(object $object): array
    {
        $reflector = new ReflectionClass($object);

        foreach ($reflector->getProperties() as $property) {
            $attributes = $property->getAttributes(
                ValidationRuleInterface::class,
                ReflectionAttribute::IS_INSTANCEOF
            );

            foreach ($attributes as $attribute) {
                $validator = $attribute->newInstance()->getValidator();

                if (!$validator->validate($property->getValue($object))) {
                    $this->errors[$property->getName()][] = sprintf(
                        $validator::Message,
                        $property->getName(),
                        $property->getName()
                    );
                }
            }
        }

        return $this->errors;
    }
}
```
