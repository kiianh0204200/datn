<?php

namespace App\Http\Requests\Admin\Product;

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
            'product_name' => ['string', 'max:255'],
            'price' => ['numeric'],
            'discount' => ['numeric'],
            'condition' => ['string', 'max:255'],
            'sub_content' => ['string', 'nullable'],
            'description' => ['string', 'nullable'],
            'color.*' => ['string', 'max:255'],
            'size.*' => ['string', 'max:255'],
            'price_option.*' => ['numeric', 'nullable'],
            'stock.*' => ['numeric', 'nullable'],
            'default.*' => ['boolean', 'nullable'],
            'brand_id' => ['integer'],
            'category_id' => ['integer'],
            'thumbnail' => ['image', 'max:2048', 'nullable'],
            'status' => ['boolean'],
            'sku' => ['string', 'nullable'],
            'images.*' => ['image', 'nullable'],
        ];
    }
}
