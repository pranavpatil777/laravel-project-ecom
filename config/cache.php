<?php

return [
    'default' => env('CACHE_STORE', 'database'),
    'stores' => [
        'array' => ['driver' => 'array'],
        'database' => ['driver' => 'database', 'table' => 'cache', 'connection' => null],
        'redis' => ['driver' => 'redis', 'connection' => 'default'],
    ],
    'prefix' => env('CACHE_PREFIX', 'ecom_cache'),
];
