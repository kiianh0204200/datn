<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductOptionValue extends Model
{
    use HasFactory;

    protected $table = 'product_option_values';

    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'price',
        'in_stock',
    ];

    protected $appends = [
        'image_url',
    ];

    public function getImageUrlAttribute(): string
    {
        return asset('uploads/products/' . $this->image);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class);
    }
}
