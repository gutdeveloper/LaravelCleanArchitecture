<?php

namespace App\Domain\Exceptions;

use Exception;

/**
 * BadRequestException class
 * This exception is thrown when there is a bad request.
 * It extends the base Exception class and sets a default message and code.
 */
class BadRequestException extends Exception
{
    protected $message = 'Bad request.';
    protected $code = 400;

    public function __construct($message = null)
    {
        if ($message) {
            $this->message = $message;
        }
    }
}
