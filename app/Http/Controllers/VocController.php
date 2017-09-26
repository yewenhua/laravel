<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use WechatService;   //引入 WechatService 门面
use Illuminate\Support\Facades\Cache;
use UtilService;

class VocController extends Controller
{

    public $bace_url = 'http://zhenglong1.vicp.net/v1';
    public $auth_url = 'http://zhenglong1.vicp.net/v1';

    const AJAX_SUCCESS = 0;
    const AJAX_FAIL = -1;
    const AJAX_NO_DATA = 10001;
    const AJAX_NO_AUTH = 99999;

    public function __construct()
    {

    }

    public function index()
    {
        return view('voc');
    }

    /**
     * 小程序login
     */
    public function wxlogin(Request $request) {
        $code = $request->input('code');
        $result = WechatService::getOpenidAndSessionkey($code);
        if($result && isset($result['openid']) && isset($result['session_key'])){
            $third_session = md5($result['openid'].'lucky'.$result['session_key']);
            $key = $third_session;
            $param = array(
                "openid" => $result['openid'],
                "session_key" => $result['session_key'],
                "expires_in" => 7200,
                "third_session" => $third_session
            );

            $res = Cache::put($key, $param, 2 * 60); //2h
            if($res){
                $value = UtilService::format_data(self::AJAX_SUCCESS, '操作成功', $third_session);
                return response()->json($value);
            }
            else{
                return UtilService::format_data(self::AJAX_FAIL, '操作失败', '');
            }
        }
        else{
            return UtilService::format_data(self::AJAX_NO_DATA, '请求失败', '');
        }
    }

    /**
     * 从缓存中读取openid和sessionkey
     */
    public function getSessionByKey(Request $request) {
        $key = $request->input('third_session');
        $res = Cache::get($key);

        if($res){
            return UtilService::format_data(self::AJAX_SUCCESS, '操作成功', $res);
        }
        else{
            return UtilService::format_data(self::AJAX_FAIL, '操作失败', '');
        }
    }

    /**
     * 获取蓝牙开锁指令
     */
    public function execute(Request $request)
    {
        $deviceId = $request->input('deviceId');
        $command = $request->input('command');
        $access_token = $request->input('access_token');
        $directive = $request->input('directive');

        $data = array(
            "deviceId" => $deviceId,
            "command" => $command,
            "directive" => $directive,
            "json_header" => true
        );

        $url = $this->bace_url . '/blueLock/execute/ff8080815de0158d015de3830ab8001e?access_token=e9cfe69b15276945d6ba6ceb5e54d7b4';
        $result = UtilService::curl_post($url, $data);
        return response()->json($result);
    }

    /**
     * 上传蓝牙开锁结果
     */
    public function result(Request $request)
    {
        $result = $request->input('result');
        $directiveId = $request->input('directiveId');
        $access_token = $request->input('access_token');

        $data = array(
            "directiveId"=>$directiveId,
            "result"=>$result,
            "json_header" => true
        );

        $url = $this->bace_url . '/blueLock/result?access_token=e9cfe69b15276945d6ba6ceb5e54d7b4';
        $result = UtilService::curl_post($url, $data);

        return response()->json($result);
    }

    /**
     * 后台登录获取token
     */
    public function signin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $access_token = $request->input('access_token');

        $data = array(
            "json_header" => true
        );

        $url = $this->auth_url. '/oauth/token?client_id=e41df05b-f963-4a66-a8cd-8596d1564fee&client_secret=3ca4b24f-d2cd-44cc-b5c9-31f88c7c5631&grant_type=password&scope=read,write&username='.$username.'&password='.$password;
        $result = UtilService::curl_post($url, $data);

        return response()->json($result);
    }

    /**
	 * 查看是否绑定
	 */
    public function checkByOpenid(Request $request) {
        $key = $request->input('third_session');
        $res = Cache::get($key);
        if($res){
            $openid = $res['openid'];
            $session_key = $res['session_key'];
        }
        else{
            return UtilService::format_data(self::AJAX_FAIL, '操作失败', '');
        }
    }

    /**
     * 绑定
     */
    public function bindByOpenid(Request $request) {
        $key = $request->input('third_session');
        $res = Cache::get($key);
        if($res){
            $openid = $res['openid'];
            $session_key = $res['session_key'];
        }
        else{
            return UtilService::format_data(self::AJAX_FAIL, '操作失败', '');
        }
    }
}
