<?php

namespace App\Enums;

enum TripSeatStatus: string
{
    case AVAILABLE = 'available';
    case RESERVED = 'reserved';
}