<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassRoom extends Model
{
    use SoftDeletes;

    // ✅ TAMBAHKAN BARIS INI - agar mengarah ke tabel 'classes'
    protected $table = 'classes';

    protected $fillable = [
        'major_id',
        'name',
        'code',
        'grade',
    ];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }
}