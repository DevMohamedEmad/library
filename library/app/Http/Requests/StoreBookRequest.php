<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'title' => 'required|string|max:100|min:2',
            'description' => 'required|string|max:100|min:5',
            'published_at' => 'required|date',
            'bio' => 'required|string|max:500|min:5',
            'cover' => 'required|file|mimes:png,jpg,jpeg,webp|max:1024',
        ];
    }
}
