<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Documentation extends Model
{
    // Kolom yang boleh diisi massal (mass assignment)
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'image',
        'video_link',
        'published_at',
        'is_published'
    ];

    // Casting tipe data
    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'date',
    ];

    // Auto-generate slug setiap kali title diisi/diubah
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}