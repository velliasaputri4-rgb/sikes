<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'class_id', 'nis', 'full_name', 'gender', 
        'birth_place', 'birth_date', 'address', 'parent_name', 
        'parent_phone', 'blood_type', 'allergy_history'
    ];

    protected $casts = ['birth_date' => 'date'];

    public function user() { return $this->belongsTo(User::class); }
    public function class() { return $this->belongsTo(ClassRoom::class, 'class_id'); }
    public function examinations() { return $this->hasMany(Examination::class); }
}