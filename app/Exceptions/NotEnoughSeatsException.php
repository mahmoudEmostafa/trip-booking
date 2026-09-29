<?php

namespace App\Exceptions;

use Exception;

class NotEnoughSeatsException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            'Not enough seats are available for this booking.'
        );
    }
}