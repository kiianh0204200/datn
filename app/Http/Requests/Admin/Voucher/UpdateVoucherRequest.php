<?php

namespace App\Http\Requests\Admin\Voucher;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVoucherRequest extends FormRequest
{
    public function rules()
    {
        return [
            'code' => 'required|string|unique:vouchers,code,' . $this->route('voucher'),
            'description' => 'nullable|string',
            'discount_type' => 'required|string',
            'discount_value' => 'required|numeric',
            'min_order_value' => 'nullable|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|boolean',
            'usage_limit' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
