<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductComment extends Model
{
    use HasFactory;

    protected $table = 'product_comments';

    protected $fillable = [
        'user_id',
        'product_id',
        'email',
        'name',
        'messages',
        'rating',
        'is_active'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
