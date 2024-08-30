<?php
// app/Models/Voucher.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'description','voucher_quantity', 'discount_type', 'discount_value', 
        'min_order_value', 'start_date', 'end_date', 'status', 'usage_limit',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'voucher_product');
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'voucher_category');
    }

    public function usages()
    {
        return $this->hasMany(VoucherUsage::class);
    }

    public function isValid()
    {
        return $this->status === 1 && 
               $this->start_date <= now() && 
               $this->end_date >= now();
    }
    public function orders()
{
    return $this->hasMany(Order::class);
}
}
