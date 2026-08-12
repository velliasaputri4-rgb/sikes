<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'classroom_id',
        'nis',
        'full_name',
        // 'gender' dihapus
        'birth_place',
        'birth_date',
        'address',
        'parent_name',
        'parent_phone',
        'blood_type',
        'allergy_history',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    // Relasi ke Classroom
    public function class()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Examination
    public function examinations()
    {
        return $this->hasMany(Examination::class);
    }
}