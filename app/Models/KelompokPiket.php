<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelompokPiket extends Model
{
    protected $fillable = [
        'nama',
    ];

    public function anggota()
    {
        return $this->hasMany(AnggotaPiket::class);
    }

    public function jadwal()
    {
        return $this->hasMany(JadwalPiket::class);
    }
}