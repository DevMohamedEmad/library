<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'name' => ['required','string','min:2','max:100'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Return a 400 status code with validation messages
        throw new HttpResponseException(response()->json([
            'status' => 400,
            'errors' => $validator->errors(),
        ], 400));
    }
}
