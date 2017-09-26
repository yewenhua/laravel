<?php

namespace App\Services;
use UtilService;

class WechatService
{
    public function getOpenidAndSessionkey($code){
        $mid = config('wechat.appid');
        $appsecret = config('wechat.appsecret');
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=".$mid."&secret=".$appsecret."&js_code=".$code."&grant_type=authorization_code";

        $result = UtilService::curl_get($url);
        if($result&& isset($result['openid'])){
            return $result;
        }
        else{
            return null;
        }
    }
}