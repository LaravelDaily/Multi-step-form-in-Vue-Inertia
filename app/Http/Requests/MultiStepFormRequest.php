<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MultiStepFormRequest extends FormRequest
{
    public function rules(): array
    {
        $step = $this->integer('step');

        return match ($step) {
            1 => [
                'step1.from_country' => ['required'],
                'step1.from_city'    => ['required'],
            ],
            2 => [
                'step2.to_country' => ['required'],
                'step2.to_city'    => ['required'],
            ],
            3 => [
                'step3.adults'   => 'required|integer|gt:0',
                'step3.children' => 'required|integer|gte:0',
            ],
            'default' => [],
        };
    }

    public function authorize(): bool
    {
        return true;
    }
}
