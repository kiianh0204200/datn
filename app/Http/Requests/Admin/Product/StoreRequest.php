<?php

namespace App\Http\Requests\Admin\Product;

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
            'product_name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'condition' => ['required', 'string', 'max:255'],
            'sub_content' => ['string', 'nullable'],
            'description' => ['string', 'nullable'],
            'color.*' => ['required', 'string', 'max:255'],
            'size.*' => ['required', 'string', 'max:255'],
            'price_option.*' => ['required', 'numeric'],
            'stock.*' => ['required', 'numeric'],
            'default.*' => ['required', 'boolean'],
            'brand_id' => ['required', 'integer'],
            'category_id' => ['required', 'integer'],
            'thumbnail' => ['required', 'image', 'max:2048'],
            'status' => ['required', 'boolean'],
            'sku' => ['string', 'nullable'],
            'images.*' => ['required', 'image'],
        ];
    }
}
