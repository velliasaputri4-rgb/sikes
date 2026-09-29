<?php

return [
    'base_url' => env('SIPINTU_BASE_URL', 'https://sipintu.smkn1bangsri.sch.id'),
    'client_id' => env('SIPINTU_CLIENT_ID'),
    'client_secret' => env('SIPINTU_CLIENT_SECRET'),
    'redirect_uri' => env('SIPINTU_REDIRECT_URI'),
    'timeout' => (int) env('SIPINTU_TIMEOUT', 120),
    'timeout_fetch' => (int) env('SIPINTU_TIMEOUT_FETCH', env('SIPINTU_TIMEOUT', 120)),
    'timeout_ping' => (int) env('SIPINTU_TIMEOUT_PING', 10),
    'retry' => min(1, max(0, (int) env('SIPINTU_RETRY', 1))),
    'sync_mode' => env('SIPINTU_SYNC_MODE', 'queue'),
    'field_map' => [
        'nis' => ['nis', 'NIS'],
        'full_name' => ['nama'],
        'address' => ['alamat'],
        'classroom_name' => ['classroom.name'],
    ],
    'queue_lock_key' => 'sipintu-sync-lock',
    'cache_ttl' => 600,
];
