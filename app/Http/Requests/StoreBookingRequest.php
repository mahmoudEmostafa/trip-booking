<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => [
                'required',
                'integer',
                'exists:customers,id',
            ],

            'trip_id' => [
                'required',
                'integer',
                'exists:trips,id',
            ],

            'seats_count' => [
                'required',
                'integer',
                'min:1',
            ],
      'employee_id' => [
       'nullable',
       'integer',
       'exists:employees,id',
], 
        ];
    }
}