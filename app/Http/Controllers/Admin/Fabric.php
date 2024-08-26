<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabric extends Model
{
    use HasFactory;

    protected $table = 'fabrics';

    protected $fillable = [
        'id',
        'fabric',
        'create_date',
        'update_date',
    ];

    public $timestamps = false;
}
