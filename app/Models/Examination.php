<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examination extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'examination_number',
        'student_id',
        'piket_group',
        'officer_name',
        'examination_date',
        'arrival_time',
        'finish_time',
        'complaint',
        'temperature',
        'blood_pressure',
        'pulse',
        'weight',
        'height',
        'bmi',
        'diagnosis',
        'medicine',
        'notes',
        'status',
        'photo',
        'qr_token',
    ];

    protected $casts = [
        'examination_date' => 'date',
        'arrival_time' => 'datetime:H:i',
        'finish_time' => 'datetime:H:i',
    ];

    // Relasi ke Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}