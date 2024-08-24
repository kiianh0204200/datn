<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
>>>>>>> 2a7a1bea2d3cf88d390af0aefb42db3259e7a90b

class Product extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = [
        'catelogue_id',
        'name',
        'slug',
        'sku',
        'img_thumbnail',
        'price_regular',
        'price_sale',
        'description',
        'content',
        'material',
        'user_manual',
        'views',
        'is_active',
        'is_hot_deal',
        'is_good_deal',
        'is_new',
        'is_show_home',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_hot_deal' => 'boolean',
        'is_good_deal' => 'boolean',
        'is_new' => 'boolean',
        'is_show_home' => 'boolean',
    ];

    public function catelogue()
    {
        return $this->belongsTo(Catelogue::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
=======
    protected $table = 'products';

    protected $fillable = [
        'brand_id',
        'product_category_id',
        'name',
        'subtitle',
        'description',
        'thumbnail',
        'slug',
        'price',
        'discount',
        'condition',
        'is_active',
        'sku',
    ];

    protected $appends = [
        'thumbnail_url',
    ];

    public function getThumbnailUrlAttribute(): string
    {
        return asset('uploads/products/' . $this->thumbnail);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function productOptions(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class, 'product_option_id', 'id');
    }

    public function color(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function size(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function productOptionValueColor(): BelongsToMany
    {
        return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'color_id')->distinct('color_id');
    }

    public function productOptionValueSize(): BelongsToMany
    {
        return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'size_id');
    }

    public function productOptionValues(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ProductComment::class, 'product_id', 'id');
    }
}

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'brand_id',
        'product_category_id',
        'name',
        'subtitle',
        'description',
        'thumbnail',
        'slug',
        'price',
        'discount',
        'condition',
        'is_active',
        'sku',
    ];

    protected $appends = [
        'thumbnail_url',
    ];

    public function getThumbnailUrlAttribute(): string
    {
        return asset('uploads/products/' . $this->thumbnail);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function productOptions(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class, 'product_option_id', 'id');
    }

    public function color(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function size(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function productOptionValueColor(): BelongsToMany
    {
        return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'color_id')->distinct('color_id');
    }

    public function productOptionValueSize(): BelongsToMany
    {
        return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'size_id');
    }

    public function productOptionValues(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ProductComment::class, 'product_id', 'id');
    }
}
class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'brand_id',
        'product_category_id',
        'name',
        'subtitle',
        'description',
        'thumbnail',
        'slug',
        'price',
        'discount',
        'condition',
        'is_active',
        'sku',
    ];

    protected $appends = [
        'thumbnail_url',
    ];

    public function getThumbnailUrlAttribute(): string
    {
        return asset('uploads/products/' . $this->thumbnail);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function productOptions(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class, 'product_option_id', 'id');
    }

    public function color(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function size(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function productOptionValueColor(): BelongsToMany
    {
        return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'color_id')->distinct('color_id');
    }

    public function productOptionValueSize(): BelongsToMany
    {
        return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'size_id');
    }

    public function productOptionValues(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ProductComment::class, 'product_id', 'id');
    }
}
class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'brand_id',
        'product_category_id',
        'name',
        'subtitle',
        'description',
        'thumbnail',
        'slug',
        'price',
        'discount',
        'condition',
        'is_active',
        'sku',
    ];

    protected $appends = [
        'thumbnail_url',
    ];

    public function getThumbnailUrlAttribute(): string
    {
        return asset('uploads/products/' . $this->thumbnail);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function productOptions(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class, 'product_option_id', 'id');
    }

    public function color(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function size(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function productOptionValueColor(): BelongsToMany
    {
        return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'color_id')->distinct('color_id');
    }

    public function productOptionValueSize(): BelongsToMany
    {
        return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'size_id');
    }

    public function productOptionValues(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ProductComment::class, 'product_id', 'id');
    }
}

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'brand_id',
        'product_category_id',
        'name',
        'subtitle',
        'description',
        'thumbnail',
        'slug',
        'price',
        'discount',
        'condition',
        'is_active',
        'sku',
    ];

    protected $appends = [
        'thumbnail_url',
    ];

    public function getThumbnailUrlAttribute(): string
    {
        return asset('uploads/products/' . $this->thumbnail);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function productOptions(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class, 'product_option_id', 'id');
    }

    public function color(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function size(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function productOptionValueColor(): BelongsToMany
    {
        return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'color_id')->distinct('color_id');
    }

    public function productOptionValueSize(): BelongsToMany
    {
        return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'size_id');
    }

    public function productOptionValues(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ProductComment::class, 'product_id', 'id');
    }
}
class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'brand_id',
        'product_category_id',
        'name',
        'subtitle',
        'description',
        'thumbnail',
        'slug',
        'price',
        'discount',
        'condition',
        'is_active',
        'sku',
    ];

    protected $appends = [
        'thumbnail_url',
    ];

    public function getThumbnailUrlAttribute(): string
    {
        return asset('uploads/products/' . $this->thumbnail);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function productOptions(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class, 'product_option_id', 'id');
    }

    public function color(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function size(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function productOptionValueColor(): BelongsToMany
    {
        return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'color_id')->distinct('color_id');
    }

    public function productOptionValueSize(): BelongsToMany
    {
        return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'size_id');
    }

    public function productOptionValues(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ProductComment::class, 'product_id', 'id');
    }
}
'thumbnail_url',
];

public function getThumbnailUrlAttribute(): string
{
    return asset('uploads/products/' . $this->thumbnail);
}

public function brand(): BelongsTo
{
    return $this->belongsTo(Brand::class, 'brand_id', 'id');
}

public function productCategory(): BelongsTo
{
    return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
}

public function productOptions(): BelongsTo
{
    return $this->belongsTo(ProductOption::class, 'product_option_id', 'id');
}

public function color(): HasMany
{
    return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
}

public function size(): HasMany
{
    return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
}

public function productOptionValueColor(): BelongsToMany
{
    return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'color_id')->distinct('color_id');
}

public function productOptionValueSize(): BelongsToMany
{
    return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'size_id');
}

public function productOptionValues(): HasMany
{
    return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
}

public function productImages(): HasMany
{
    return $this->hasMany(ProductImage::class, 'product_id', 'id');
}

public function comments(): HasMany
{
    return $this->hasMany(ProductComment::class, 'product_id', 'id');
}
}
class Product extends Model
{
use HasFactory;

protected $table = 'products';

protected $fillable = [
    'brand_id',
    'product_category_id',
    'name',
    'subtitle',
    'description',
    'thumbnail',
    'slug',
    'price',
    'discount',
    'condition',
    'is_active',
    'sku',
];

protected $appends = [
    'thumbnail_url',
];

public function getThumbnailUrlAttribute(): string
{
    return asset('uploads/products/' . $this->thumbnail);
}

public function brand(): BelongsTo
{
    return $this->belongsTo(Brand::class, 'brand_id', 'id');
}

public function productCategory(): BelongsTo
{
    return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
}

public function productOptions(): BelongsTo
{
    return $this->belongsTo(ProductOption::class, 'product_option_id', 'id');
}

public function color(): HasMany
{
    return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
}

public function size(): HasMany
{
    return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
}

public function productOptionValueColor(): BelongsToMany
{
    return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'color_id')->distinct('color_id');
}

public function productOptionValueSize(): BelongsToMany
{
    return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'size_id');
}

public function productOptionValues(): HasMany
{
    return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
}

public function productImages(): HasMany
{
    return $this->hasMany(ProductImage::class, 'product_id', 'id');
}

public function comments(): HasMany
{
    return $this->hasMany(ProductComment::class, 'product_id', 'id');
}
}
class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'brand_id',
        'product_category_id',
        'name',
        'subtitle',
        'description',
        'thumbnail',
        'slug',
        'price',
        'discount',
        'condition',
        'is_active',
        'sku',
    ];

    protected $appends = [
        'thumbnail_url',
    ];

    public function getThumbnailUrlAttribute(): string
    {
        return asset('uploads/products/' . $this->thumbnail);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function productOptions(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class, 'product_option_id', 'id');
    }

    public function color(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function size(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function productOptionValueColor(): BelongsToMany
    {
        return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'color_id')->distinct('color_id');
    }

    public function productOptionValueSize(): BelongsToMany
    {
        return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'size_id');
    }

    public function productOptionValues(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
    }

    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ProductComment::class, 'product_id', 'id');
    }
}
'thumbnail_url',
];

public function getThumbnailUrlAttribute(): string
{
    return asset('uploads/products/' . $this->thumbnail);
}

public function brand(): BelongsTo
{
    return $this->belongsTo(Brand::class, 'brand_id', 'id');
}

public function productCategory(): BelongsTo
{
    return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
}

public function productOptions(): BelongsTo
{
    return $this->belongsTo(ProductOption::class, 'product_option_id', 'id');
}

public function color(): HasMany
{
    return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
}

public function size(): HasMany
{
    return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
}

public function productOptionValueColor(): BelongsToMany
{
    return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'color_id')->distinct('color_id');
}

public function productOptionValueSize(): BelongsToMany
{
    return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'size_id');
}

public function productOptionValues(): HasMany
{
    return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
}

public function productImages(): HasMany
{
    return $this->hasMany(ProductImage::class, 'product_id', 'id');
}

public function comments(): HasMany
{
    return $this->hasMany(ProductComment::class, 'product_id', 'id');
}
}
class Product extends Model
{
use HasFactory;

protected $table = 'products';

protected $fillable = [
    'brand_id',
    'product_category_id',
    'name',
    'subtitle',
    'description',
    'thumbnail',
    'slug',
    'price',
    'discount',
    'condition',
    'is_active',
    'sku',
];

protected $appends = [
    'thumbnail_url',
];

public function getThumbnailUrlAttribute(): string
{
    return asset('uploads/products/' . $this->thumbnail);
}

public function brand(): BelongsTo
{
    return $this->belongsTo(Brand::class, 'brand_id', 'id');
}

public function productCategory(): BelongsTo
{
    return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
}

public function productOptions(): BelongsTo
{
    return $this->belongsTo(ProductOption::class, 'product_option_id', 'id');
}

public function color(): HasMany
{
    return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
}

public function size(): HasMany
{
    return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
}

public function productOptionValueColor(): BelongsToMany
{
    return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'color_id')->distinct('color_id');
}

public function productOptionValueSize(): BelongsToMany
{
    return $this->belongsToMany(ProductOption::class, 'product_option_values', 'product_id', 'size_id');
}

public function productOptionValues(): HasMany
{
    return $this->hasMany(ProductOptionValue::class, 'product_id', 'id');
}

public function productImages(): HasMany
{
    return $this->hasMany(ProductImage::class, 'product_id', 'id');
}

public function comments(): HasMany
{
    return $this->hasMany(ProductComment::class, 'product_id', 'id');
}
}
>>>>>>> 2a7a1bea2d3cf88d390af0aefb42db3259e7a90b
