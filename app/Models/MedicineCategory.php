<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicineCategory extends Model
{
    use SoftDeletes;

    // Beritahu Laravel nama tabelnya (opsional, tapi aman)
    protected $table = 'medicine_categories';

    protected $fillable = ['name'];

    public function medicines()
    {
        return $this->hasMany(Medicine::class, 'category_id');
    }
}