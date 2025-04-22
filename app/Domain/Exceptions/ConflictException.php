<?php

namespace App\Domain\Exceptions;

use Exception;

/**
 * ConflictException class
 * This exception is thrown when there is a conflict in the request.
 * It extends the base Exception class and sets a default message and code.
 */
class ConflictException extends Exception
{
    protected $message = 'Conflict occurred.';
    protected $code = 409;
    
    public function __construct($message = null)
    {
        if ($message) {
            $this->message = $message;
        }
    }
}
