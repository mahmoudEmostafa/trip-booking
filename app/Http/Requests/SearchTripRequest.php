<?php

namespace App\Http\Requests;

use App\Enums\TripType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class SearchTripRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'destination_city' => [
                'required',
                'string',
                'max:100',
            ],

            'type' => [
                'required',
                new Enum(TripType::class),
            ],

            'seats_count' => [
                'required',
                'integer',
                'min:1',
            ],

            'date' => [
                'required',
                'date_format:Y-m-d',
            ],
        ];
    }
}