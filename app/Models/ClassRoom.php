<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    // Tabel di database adalah 'classrooms', bukan 'classes'
    protected $table = 'classrooms';

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
        return $this->hasMany(Student::class, 'classroom_id');
    }
}
   