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
        'category_id',       // ✅ TAMBAHKAN INI
        'stock',
        'minimum_stock',
        'unit',
        'expired_date',
        'description',
        'status',
    ];

    // Relasi ke Kategori (jika belum ada, tambahkan ini)
    public function category()
    {
        return $this->belongsTo(MedicineCategory::class, 'category_id');
    }
}