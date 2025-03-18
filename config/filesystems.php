<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => '84cdf242bd06a3720e9cf306ae11acb7',
            'secret' => '85b0c0a3f7a83e9d48048aceb1703b57f54ca09b1fa6ee41ea4e51d5d8b1b8be',
            'region' => 'us-east-1',
            'bucket' => 'fls-9e75cf98-b353-40cb-ae65-d20818f8eccc',
            'url' => 'https://fls-9e75cf98-b353-40cb-ae65-d20818f8eccc.laravel.cloud',
            'endpoint' => 'https://367be3a2035528943240074d0096e0cd.r2.cloudflarestorage.com',
            'use_path_style_endpoint' => false,
            'throw' => false,
            'report' => false,
        ],

        'r2' => [
            'driver' => 's3',
            'key' => '84cdf242bd06a3720e9cf306ae11acb7',
            'secret' => '85b0c0a3f7a83e9d48048aceb1703b57f54ca09b1fa6ee41ea4e51d5d8b1b8be',
            'region' => 'us-east-1',
            'bucket' => 'fls-9e75cf98-b353-40cb-ae65-d20818f8eccc',
            'url' => 'https://fls-9e75cf98-b353-40cb-ae65-d20818f8eccc.laravel.cloud',
            'endpoint' => 'https://367be3a2035528943240074d0096e0cd.r2.cloudflarestorage.com',
            'use_path_style_endpoint' => false,
            'throw' => false,
            'report' => false,
        ],
    ],
    

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
