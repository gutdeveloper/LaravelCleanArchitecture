<?php

namespace App\Domain\Exceptions;

use Exception;

/**
 * InternalServerException class
 * This exception is thrown when there is an internal server error.
 * It extends the base Exception class and sets a default message and code.
 */
class InternalServerException extends Exception
{
    protected $message = 'Internal server error.';
    protected $code = 500;

    public function __construct($message = null)
    {
        if ($message) {
            $this->message = $message;
        }
    }
}
