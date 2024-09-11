<?php

// app/Models/VoucherCategory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherCategory extends Model
{
    use HasFactory;

    protected $fillable = ['voucher_id', 'category_id'];

    public $timestamps = false;
}

