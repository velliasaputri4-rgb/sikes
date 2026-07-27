<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $fillable = [
        'item_id', 'student_id', 'borrowed_by', 'borrow_date',
        'expected_return_date', 'return_date', 'status', 'notes'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function borrowedBy()
    {
        return $this->belongsTo(User::class, 'borrowed_by');
    }
}