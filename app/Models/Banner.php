<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners';

    protected $fillable = [
        'header_title',
        'title',
        'sub_title',
        'description',
        'image',
        'status',
        'priority',
        'link'
    ];

    protected $appends = [
        'image_url'
    ];
    public function getImageUrlAttribute(): string
    {
        return asset('uploads/banner/' . $this->image);
    }
}
