<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_name',
        'members',
        'description',
        'is_active',
    ];

    // Otomatis mengkonversi JSON ke Array saat diambil, dan Array ke JSON saat disimpan
    protected $casts = [
        'members' => 'array',
        'is_active' => 'boolean',
    ];
}