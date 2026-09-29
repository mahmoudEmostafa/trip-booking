<?php

namespace App\Exceptions;

use Exception;

class TripNotBookableException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            'This trip is not available for booking.'
        );
    }
}