<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class InvalidPasswordException extends Exception
{
    public function __construct($message = "", $code = Response::HTTP_BAD_REQUEST, Throwable $previous = null)
    {
        parent::__construct($message === '' ? __('validation.password'): $message, $code, $previous);
    }
}
