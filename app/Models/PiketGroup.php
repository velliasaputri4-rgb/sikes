<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PiketGroup extends Model
{
    protected $table = 'kelompok_pikets'; // sesuaikan dengan nama tabel di migration
    
    protected $fillable = ['name', 'order'];
    
    public function members()
    {
        return $this->hasMany(PiketMember::class, 'kelompok_piket_id');
    }
    
    public function contacts()
    {
        return $this->hasMany(PiketContact::class, 'kelompok_piket_id');
    }
}