<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examination extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'examination_number', 'student_id', 'officer_id', 'examination_date',
        'arrival_time', 'finish_time', 'complaint', 'temperature', 'blood_pressure',
        'pulse', 'weight', 'height', 'bmi', 'diagnosis', 'treatment', 'status', 'qr_token'
    ];

    protected $casts = [
        'examination_date' => 'date',
        'temperature' => 'decimal:1', 'weight' => 'decimal:2', 'height' => 'decimal:2', 'bmi' => 'decimal:2'
    ];

    public function student() { return $this->belongsTo(Student::class); }
    public function officer() { return $this->belongsTo(Officer::class); }
    public function medicines() { return $this->belongsToMany(Medicine::class, 'examination_medicines')->withPivot('qty'); }
    public function photos() { return $this->hasMany(ExaminationPhoto::class); }
}