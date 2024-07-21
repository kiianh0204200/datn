<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    protected $fillable = [
        'order_id',
        'product_id',
        'name',
        'price',
        'color',
        'size',
        'quantity',
        'total',
        'image'
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(): string
    {
        return asset('uploads/products/' . $this->image);
    }
}
