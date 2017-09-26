<?php

namespace App\Services;

class WxpayService
{
    public function notify(){
        //获取自定义配置，没有配置则取默认
        $mid = config('wechat.mid');
        return $mid;
    }
}