<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    // 1. Traits (Biasanya diletakkan di paling atas class)
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    // 2. Fillable Properties
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'photo',
        'status',
        'last_login_at',
    ];

    // 3. Hidden Properties
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 4. Casts
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'password' => 'hashed',
    ];

    // 5. Relationships
    
    /**
     * Relasi ke Student (Jika user tersebut adalah siswa)
     */
    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    /**
     * Relasi ke Examination (Jika user tersebut adalah Petugas UKS)
     * Ini sangat berguna untuk menampilkan riwayat pemeriksaan yang dilakukan oleh petugas tertentu.
     */
    public function examinations(): HasMany
    {
        return $this->hasMany(Examination::class, 'officer_id');
    }
}