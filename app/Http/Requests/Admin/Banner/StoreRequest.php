<?php

namespace App\Http\Requests\Admin\Banner;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'header_title' => ['nullable', 'string'],
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'sub_title' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
            'image' => ['required', 'image', 'max:2048'],
            'priority' => ['required', 'string'],
            'link' => ['nullable', 'string'],
        ];
    }
}
