<?php

namespace App\Exceptions;

class UserLoginValidationException extends \Exception
{
    protected $message = 'Please write correct email or password!';

    protected $code = 401;
}
