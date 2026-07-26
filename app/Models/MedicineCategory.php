<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineCategory extends Model
{
    // Hapus baris ini: use SoftDeletes;

    protected $table = 'medicine_categories';

    protected $fillable = ['name'];

    public function medicines()
    {
        return $this->hasMany(Medicine::class, 'category_id');
    }
}