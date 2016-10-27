<?php
return [
    'use_alias' => env('WECHAT_USE_ALIAS', false),
    'app_id' => env('WECHAT_APPID', 'Your AppId'), // 必填
    'secret' => env('WECHAT_SECRET', 'Your Secret'), // 必填
    'token' => env('WECHAT_TOKEN', 'Your Token'), // 必填
    'encoding_key' => env('WECHAT_ENCODING_KEY', 'Your Encoding AES Key') // 只有加密模式需要
];