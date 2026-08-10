<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'classroom_id', 'nis', 'full_name', 'gender',
        'birth_place', 'birth_date', 'address', 'parent_name',
        'parent_phone', 'blood_type', 'allergy_history'
    ];

    protected $casts = ['birth_date' => 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Nama method tetap `class` supaya view lama tidak perlu diubah,
    // tapi foreign key diarahkan ke kolom asli: classroom_id
    public function class()
    {
        return $this->belongsTo(ClassRoom::class, 'classroom_id');
    }

    // Alias, biar aman kalau ada kode yang memanggil ->classroom
    public function classroom()
    {
        return $this->belongsTo(ClassRoom::class, 'classroom_id');
    }

    public function examinations()
    {
        return $this->hasMany(Examination::class);
    }
}