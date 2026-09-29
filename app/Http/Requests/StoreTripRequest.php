<?php

namespace App\Http\Requests;

use App\Enums\TripType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreTripRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bus_id' => [
                'required',
                'integer',
                'exists:buses,id',
            ],

            'employee_id' => [
                'required',
                'integer',
                'exists:employees,id',
            ],

            'departure_city' => [
                'required',
                'string',
                'max:100',
            ],

            'destination_city' => [
                'required',
                'string',
                'max:100',
                'different:departure_city',
            ],

            'departure_at' => [
                'required',
                'date',
                'after:now',
            ],

            'arrival_at' => [
                'required',
                'date',
                'after:departure_at',
            ],

            'type' => [
                'required',
                new Enum(TripType::class),
            ],
        ];
    }
}