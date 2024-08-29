<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherUsage extends Model
{
    use HasFactory;

    protected $fillable = ['voucher_id', 'user_id', 'order_id', 'used_at'];

    public $timestamps = false;
}