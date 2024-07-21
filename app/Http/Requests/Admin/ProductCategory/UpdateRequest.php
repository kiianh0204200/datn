<?php

namespace App\Http\Requests\Admin\ProductCategory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (bool) auth()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'image' => ['image', 'max:2048'],
            'description' => ['nullable', 'string'],
            'status' => ['boolean'],
            'parent_id' => ['integer', 'nullable'],
        ];
    }
}
