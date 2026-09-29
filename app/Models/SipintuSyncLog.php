<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SipintuSyncLog extends Model
{
    use HasFactory;

    protected $table = 'sipintu_sync_logs';

    protected $fillable = [
        'user_id',
        'status',
        'total',
        'processed',
        'created_count',
        'updated_count',
        'skipped_count',
        'failed_count',
        'error_message',
        'warnings',
        'started_at',
        'finished_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
        'warnings' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
