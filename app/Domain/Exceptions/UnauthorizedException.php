<?php

namespace App\Domain\Exceptions;

use Exception;

/**
 * UnauthorizedException class
 * This exception is thrown when a user is not authorized to perform an action.
 * It extends the base Exception class and sets a default message and code.
 */
class UnauthorizedException extends Exception
{
    protected $message = 'Unauthorized action.';
    protected $code = 401;

    public function __construct($message = null)
    {
        if ($message) {
            $this->message = $message;
        }
    }
}
