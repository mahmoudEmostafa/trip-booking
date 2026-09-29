<?php

namespace App\Exceptions;

use Exception;

class BusAlreadyScheduledException extends Exception
{
    public function __construct(
        string $message = 'The bus is already scheduled for another trip during this time.'
    ) {
        parent::__construct($message);
    }
}