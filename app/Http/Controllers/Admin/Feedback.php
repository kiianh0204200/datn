<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks'; // Tên của bảng

    protected $fillable = [ // Các cột có thể được gán dữ liệu
        'user_id',
        'feed_back_name',
        'feed_back_email',
        'feed_back_phone',
        'feed_back_title',
        'feedback_content',
        'status'
    ];
}

