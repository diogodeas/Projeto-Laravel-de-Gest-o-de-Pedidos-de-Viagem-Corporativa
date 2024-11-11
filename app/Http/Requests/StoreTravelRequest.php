<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTravelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'applicant_name' => 'required|string',
            'destination' => 'required|string',
            'start_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|in:solicitado,aprovado,cancelado',
        ];
    }
}
