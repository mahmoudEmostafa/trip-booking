<?php

namespace App\Exceptions;

use Exception;

class CancellationNotAllowedException extends Exception
{
    public function __construct(
        string $message = 'Booking cancellation is no longer allowed.'
    ) {
        parent::__construct($message);
    }
}