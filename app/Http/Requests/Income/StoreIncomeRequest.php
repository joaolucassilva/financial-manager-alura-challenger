<?php

namespace App\Http\Requests\Income;

use App\Helpers\ResponseError;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreIncomeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'value' => 'required|integer',
            'description' => 'required|max:255|min:10',
            'date' => 'required|date|date_format:Y/m/d'
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $response = ResponseError::get(
            data: $validator->errors(),
            status: 400
        );

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
