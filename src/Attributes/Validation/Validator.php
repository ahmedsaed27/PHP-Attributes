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
        // get the reflaction class

        $reflector = new ReflectionClass($object);

        // loop on it to get all property
        foreach($reflector->getProperties() as $property){

            // make shre the property is instance of ValidationRuleInterface 
            $attributes = $property->getAttributes(
                ValidationRuleInterface::class,
                ReflectionAttribute::IS_INSTANCEOF
            );

            // loop in the attributes
            foreach($attributes as $attribute){
                // call getValidator method
                $validator = $attribute->newInstance()->getValidator();

                if(!$validator->validate($property->getValue($object)))
                {
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
