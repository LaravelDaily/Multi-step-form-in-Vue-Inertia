<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MultiStepFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'step1.from_country' => ['required'],
            'step1.from_city'    => ['required'],

            'step2.to_country' => ['required'],
            'step2.to_city'    => ['required', 'different:step1.from_city'],

            'step3.adults'   => ['required', 'integer', 'gt:0'],
            'step3.children' => ['required', 'integer', 'gte:0'],
        ];

    }

    public function authorize(): bool
    {
        return true;
    }
}
