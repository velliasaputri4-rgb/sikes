<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PiketContact extends Model
{
    protected $table = 'jadwal_pikets';
    
    protected $fillable = ['kelompok_piket_id', 'name', 'phone'];
    
    public function group()
    {
        return $this->belongsTo(PiketGroup::class, 'kelompok_piket_id');
    }
}