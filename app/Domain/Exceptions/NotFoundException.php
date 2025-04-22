<?php

namespace App\Domain\Exceptions;

use Exception;

/**
 * NotFoundException class
 * This exception is thrown when there is an internal server error.
 * It extends the base Exception class and sets a default message and code.
 */
class NotFoundException extends Exception
{
    protected $message = 'Not found.';
    protected $code = 404;

    public function __construct($message = null)
    {
        if ($message) {
            $this->message = $message;
        }
    }
}
