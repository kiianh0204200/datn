<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kalnoy\Nestedset\NodeTrait;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_categories';
    protected $fillable = [
        'name',
        'image',
        'description',
        'slug',
        'is_active',
        'parent_id',
        'image'
    ];

    protected $appends = [
        'image_url',
    ];

    protected $connection = 'mysql';

    public function getImageUrlAttribute(): string
    {
        return asset('uploads/product-category/' . $this->image);
    }

    public function children(): HasMany
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }
}
