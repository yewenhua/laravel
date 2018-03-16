<?php

namespace App\Services;
use UtilService;

class WechatService
{
    public function getOpenidAndSessionkey($code){
        $appid = config('mini.appid');
        $appsecret = config('mini.appsecret');
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=".$appsecret."&js_code=".$code."&grant_type=authorization_code";

        $result = UtilService::curl_get($url);
        if($result&& isset($result['openid'])){
            return $result;
        }
        else{
            return null;
        }
    }

    private function getPageUrl(){
        $url = (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443') ? 'https://' : 'http://';
        $url .= $_SERVER['HTTP_HOST'];
        $url .= isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : urlencode($_SERVER['PHP_SELF']) . '?' . urlencode($_SERVER['QUERY_STRING']);
        return $url;
    }

    /**
     * 官方access_token有效时间为7200S， 本例设置为6000S，过期后再去重新获取
     * 获取accesstoken...
     * 若正确返回access_token，否则返回null
     */
    private function getAccessToken() {
        $appId = config('wechat.appid');
        $appSecret = config('wechat.appsecret');
        $data = json_decode(file_get_contents(dirname(__FILE__)."/access_token.json"));
        if ($data == null || empty($data) || $data->expire_time < time()) {
            if ($data == null || empty($data)){
                //accesstoken为空
                $data = (object)array();
            }

            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appId."&secret=".$appSecret;
            $result = UtilService::curl_get($url);
            if($result && isset($result['access_token'])){
                //请求接口成功
                $accessToken = $result['access_token'];
                $data->expire_time = time() + 6000;
                $data->access_token = $accessToken;
                $fp = fopen(dirname(__FILE__)."/access_token.json", "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
            }
            else{
                //请求接口失败
                $accessToken = null;
                $fileName = dirname(__FILE__)."/access_token.json";
                if(file_exists($fileName)){
                    //accesstoken清空
                    file_put_contents($fileName, '');
                }
            }
        }
        else {
            //accesstoken有效
            $accessToken = $data->access_token;
        }

        return $accessToken;
    }

    /**
     * 官方jsapi_ticket有效时间为7200S， 本例设置为6000S，过期后再去重新获取
     * 获取jsapi_ticket...
     * 若正确返回jsapi_ticket，否则返回null
     */
    private function getJsapiTicket() {
        $data = json_decode(file_get_contents(dirname(__FILE__)."/jsapi_ticket.json"));
        if ($data == null || empty($data) || $data->expire_time < time()) {
            if ($data == null || empty($data)){
                //jsapi_ticket为空
                $data = (object)array();
            }

            $accesstoken = $this->getAccessToken();
            if($accesstoken !== null){
                $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$accesstoken.'&type=jsapi';
                $result = UtilService::curl_get($url);
                if($result && $result['errcode'] == 0 &&  isset($result['ticket'])){
                    //getJsapiTicket请求接口成功
                    $jsapi_ticket = $result['ticket'];
                    $data->expire_time = time() + 6000;
                    $data->jsapi_ticket = $jsapi_ticket;
                    $fp = fopen(dirname(__FILE__)."/jsapi_ticket.json", "w");
                    fwrite($fp, json_encode($data));
                    fclose($fp);
                }
                else{
                    //getJsapiTicket请求接口失败
                    $jsapi_ticket = null;
                    $fileName = dirname(__FILE__)."/jsapi_ticket.json";
                    if(file_exists($fileName)){
                        //jsapi_ticket清空
                        file_put_contents($fileName, '');
                    }
                }
            }
            else{
                //accesstoken请求接口失败
                $jsapi_ticket = null;
            }
        }
        else {
            //jsapi_ticket有效
            $jsapi_ticket = $data->jsapi_ticket;
        }

        return $jsapi_ticket;
    }

    private function getAccessTokenService() {
        $appId = config('wechat.appid_service');
        $appSecret = config('wechat.appsecret_service');
        $data = json_decode(file_get_contents(dirname(__FILE__)."/access_token_service.json"));
        if ($data == null || empty($data) || $data->expire_time < time()) {
            if ($data == null || empty($data)){
                //accesstoken为空
                $data = (object)array();
            }

            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appId."&secret=".$appSecret;
            $result = UtilService::curl_get($url);
            if($result && isset($result['access_token'])){
                //请求接口成功
                $accessToken = $result['access_token'];
                $data->expire_time = time() + 6000;
                $data->access_token = $accessToken;
                $fp = fopen(dirname(__FILE__)."/access_token_service.json", "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
            }
            else{
                //请求接口失败
                $accessToken = null;
                $fileName = dirname(__FILE__)."/access_token_service.json";
                if(file_exists($fileName)){
                    //accesstoken清空
                    file_put_contents($fileName, '');
                }
            }
        }
        else {
            //accesstoken有效
            $accessToken = $data->access_token;
        }

        return $accessToken;
    }

    /**
     * 官方jsapi_ticket有效时间为7200S， 本例设置为6000S，过期后再去重新获取
     * 获取jsapi_ticket...
     * 若正确返回jsapi_ticket，否则返回null
     */
    private function getJsapiTicketService() {
        $data = json_decode(file_get_contents(dirname(__FILE__)."/jsapi_ticket_service.json"));
        if ($data == null || empty($data) || $data->expire_time < time()) {
            if ($data == null || empty($data)){
                //jsapi_ticket为空
                $data = (object)array();
            }

            $accesstoken = $this->getAccessTokenService();
            if($accesstoken !== null){
                $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$accesstoken.'&type=jsapi';
                $result = UtilService::curl_get($url);
                if($result && $result['errcode'] == 0 &&  isset($result['ticket'])){
                    //getJsapiTicket请求接口成功
                    $jsapi_ticket = $result['ticket'];
                    $data->expire_time = time() + 6000;
                    $data->jsapi_ticket = $jsapi_ticket;
                    $fp = fopen(dirname(__FILE__)."/jsapi_ticket_service.json", "w");
                    fwrite($fp, json_encode($data));
                    fclose($fp);
                }
                else{
                    //getJsapiTicket请求接口失败
                    $jsapi_ticket = null;
                    $fileName = dirname(__FILE__)."/jsapi_ticket_service.json";
                    if(file_exists($fileName)){
                        //jsapi_ticket清空
                        file_put_contents($fileName, '');
                    }
                }
            }
            else{
                //accesstoken请求接口失败
                $jsapi_ticket = null;
            }
        }
        else {
            //jsapi_ticket有效
            $jsapi_ticket = $data->jsapi_ticket;
        }

        return $jsapi_ticket;
    }

    private function ToUrlParams($urlObj)
    {
        $buff = "";
        foreach ($urlObj as $k => $v)
        {
            if($k != "sign"){
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }

    public function jsapi(){
        $param_url = $this->getPageUrl();
        $jsapi_ticket = $this->getJsapiTicket();
        $appid = config('wechat.appid');
        $params = array();
        $params["url"] = $param_url;
        $params["timestamp"] = time();
        $noncestr = rand(1000000, 9999999);
        $params["noncestr"] = "$noncestr";
        $params["jsapi_ticket"] = $jsapi_ticket;
        ksort($params);
        $paramString = $this->ToUrlParams($params);
        $addrSign = sha1($paramString);

        $data = array(
            "signature" => $addrSign,
            "appId" => $appid,
            "timeStamp" => $params["timestamp"],
            "nonceStr" => $params["noncestr"],
        );
        return $data;
    }

    public function jsapi_service(){
        $param_url = $this->getPageUrl();
        $jsapi_ticket = $this->getJsapiTicketService();
        $appid = config('wechat.appid_service');
        $params = array();
        $params["url"] = $param_url;
        $params["timestamp"] = time();
        $noncestr = rand(1000000, 9999999);
        $params["noncestr"] = "$noncestr";
        $params["jsapi_ticket"] = $jsapi_ticket;
        ksort($params);
        $paramString = $this->ToUrlParams($params);
        $addrSign = sha1($paramString);

        $data = array(
            "signature" => $addrSign,
            "appId" => $appid,
            "timeStamp" => $params["timestamp"],
            "nonceStr" => $params["noncestr"],
        );
        return $data;
    }
}