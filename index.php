<?php

use As984\PhpAttributes\Attributes\Validation\Validator;
use As984\PhpAttributes\DTO\UserRegistration;

require_once './vendor/autoload.php';

$userRegistration = new UserRegistration(username:'' , email:'as@gmail' , phone:'011');

$validator = new Validator();

$validator->validate($userRegistration);

dd($validator);
