<?php

namespace App\Http\Requests\Admin\Banner;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (bool)auth()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'header_title' => ['string'],
            'title' => ['string'],
            'description' => ['nullable', 'string'],
            'sub_title' => ['nullable', 'string'],
            'status' => ['boolean'],
            'image' => ['image', 'max:2048'],
            'priority' => ['string'],
            'link' => ['nullable', 'string'],
        ];
    }
}
