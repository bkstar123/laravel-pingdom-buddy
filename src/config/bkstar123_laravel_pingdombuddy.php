<?php
/**
 * All settings for bkstar123/laravel-pingdom-buddy package
 *
 * @author: tuanha
 * @date: 23-Oct-2021
 */

return [
    'pingdom' => [
        'base_url' => env('PINGDOM_BASE_URI'),
        'api_token' => env('PINGDOM_API_TOKEN', ''),
    ]
];
