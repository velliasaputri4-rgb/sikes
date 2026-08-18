<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PiketMember extends Model
{
    protected $table = 'anggota_pikets';
    
    protected $fillable = ['kelompok_piket_id', 'name', 'role'];
    
    public function group()
    {
        return $this->belongsTo(PiketGroup::class, 'kelompok_piket_id');
    }
}