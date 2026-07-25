<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    // Tambahkan HasFactory di sini
    use HasFactory, Notifiable, SoftDeletes, HasRoles;
// Di dalam class User (app/Models/User.php)

public function student()
{
    return $this->hasOne(Student::class);
}
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'photo',
        'status',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'password' => 'hashed',
    ];
}
