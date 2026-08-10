<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPiket extends Model
{
    protected $fillable = [
        'kelompok_piket_id',
        'tanggal',
        'jenis',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function kelompok()
    {
        return $this->belongsTo(KelompokPiket::class, 'kelompok_piket_id');
    }

    public function getJenisLabelAttribute(): string
    {
        return ucwords(str_replace('_', ' ', $this->jenis));
    }

    public function getTanggalIndonesiaAttribute(): string
    {
        return $this->tanggal->translatedFormat('l, d F Y');
    }
}