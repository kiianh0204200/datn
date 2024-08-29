<?php

// app/Models/VoucherProduct.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherProduct extends Model
{
    use HasFactory;

    protected $fillable = ['voucher_id', 'product_id'];

    public $timestamps = false;
}

