<?php
namespace App\Enums;

enum TripStatus: string
{
    case SCHEDULED = 'scheduled';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';
}