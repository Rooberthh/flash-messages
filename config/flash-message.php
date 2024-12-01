<?php

use Rooberthh\FlashMessage\Domain\Support\Enums\Driver;

return [
    'default_channel' => env('FLASH_MESSAGE_DEFAULT_CHANNEL', 'default'),
    'database_connection' => env('FLASH_MESSAGE_DB_CONNECTION'),
    'driver' => env('FLASH_MESSAGE_DRIVER', Driver::SESSION),
    'statuses' => [
        'success' => [
            'color' => '#22c55e',
        ],
        'danger' => [
            'color' => '#ef4444',
        ],
        'info' => [
            'color' => '#3b82f6',
        ],
    ],
];
