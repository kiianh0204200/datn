<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'excerpt',
        'content',
        'thumbnail',
        'is_published',
        'slug',
    ];

    protected $appends = [
        'thumbnail_url'
    ];

    public function getThumbnailUrlAttribute(): string
    {
        return asset('uploads/posts/' . $this->thumbnail);
    }

    public function postCategory(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
