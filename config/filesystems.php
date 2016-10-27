<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. A "local" driver, as well as a variety of cloud
    | based drivers are available for your choosing. Just store away!
    |
    | Supported: "local", "ftp", "s3", "rackspace"
    |
    */

    'default' => 'qiniu',

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => 's3',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => 'your-key',
            'secret' => 'your-secret',
            'region' => 'your-region',
            'bucket' => 'your-bucket',
        ],
        'qiniu' => [
            'driver' => 'qiniu',
            'domains' => [
                'default' => 'cdn.4255.cn', //你的七牛域名env('APP_LOG', 'single')
                'https' => 'cdn.4255.cn',         //你的HTTPS域名
                'custom' => 'cdn.4255.cn',     //你的自定义域名
            ],
            'access_key' => 'hexBRHOH4YjkHohx8k7d_gnx1Zj5q0Or-0BDE8Kb',  //AccessKey
            'secret_key' => 'sK2lp5_1bTd8Qkhh7xSXj2ZC6f1WaD6Km7CjJixa',  //SecretKey
            'bucket' => 'weiliwang',  //Bucket名字
            'notify_url' => 'http://oa4ykfuon.bkt.clouddn.com',  //持久化处理回调地址
        ],
    ],

];
