<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggotaPiket extends Model
{
    protected $fillable = [
        'kelompok_piket_id',
        'nama',
        'telepon',
        'is_kontak',
    ];

    protected $casts = [
        'is_kontak' => 'boolean',
    ];

    public function kelompok()
    {
        return $this->belongsTo(KelompokPiket::class, 'kelompok_piket_id');
    }
}