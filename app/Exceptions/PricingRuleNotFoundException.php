<?php

namespace App\Exceptions;

use Exception;

class PricingRuleNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            'No pricing rule was found for this trip.'
        );
    }
}