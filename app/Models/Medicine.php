<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'stock',
        'minimum_stock',
        'unit',
        'expired_date',
        'description',
        'status',
    ];

    // ✅ Relasi category dihapus karena kolom category_id sudah tidak ada di database
}