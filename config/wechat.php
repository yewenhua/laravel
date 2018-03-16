<?php

/*
 * wxpay
 */

return [
    'mid' => env('WXPAYMID',"123456"),
    'appid' => env('APPID',"wxb4b8988c75c775ed"),
    'appsecret' => env('APPSECRET',"19bb10553a43e605bf7189aa109e1ca0"),
    //'appid_service' => env('APPID',"wx77e8f0d1b45a571d"),
    //'appsecret_service' => env('APPSECRET',"1e0ca6cca416bd009b787b3e93efaadb"),
    'appid_service' => env('APPID',"wxb4b8988c75c775ed"),
    'appsecret_service' => env('APPSECRET',"19bb10553a43e605bf7189aa109e1ca0"),
    'wxapiurl' => env('WXAPIURL',"https://wl.voc.so")
];