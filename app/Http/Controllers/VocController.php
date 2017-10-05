<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use WechatService;   //引入 WechatService 门面
use Illuminate\Support\Facades\Cache;
use UtilService;
use Illuminate\Support\Facades\Redis;

class VocController extends Controller
{

    public $bace_url = 'http://lock.voc.so:8081/v1';
    public $auth_url = 'http://wl.voc.so:8081';

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
    public function blueExecute(Request $request)
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
    public function blueResult(Request $request)
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
     * 获取wifi开锁指令
     */
    public function wifiExecute(Request $request)
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
     * 上传wifi开锁结果
     */
    public function wifiResult(Request $request)
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

    //点击分享按钮回调打开分享标签
    public function shareBegin(Request $request){
        $uid = $request->input('uid');
        $key = 'share_begin_'.$uid;
        $param = array(
            'uid'=>$uid
        );

        //write cache begin flag
        $res = Cache::put($key, $param, 60); //1h
        if($res){
            return UtilService::format_data(self::AJAX_SUCCESS, '操作成功', '');
        }
        else{
            return UtilService::format_data(self::AJAX_FAIL, '操作失败', '');
        }
    }

    public function shareOpen(Request $request){
        $uid = $request->input('uid');
        $key = 'share_begin_'.$uid;
        $res = Cache::get($key);
        if($res) {
            $redis_name = 'share_key_' . $uid;

            if (Redis::lLen($redis_name) < 1) {
                Redis::rPush($redis_name, $uid . '%' . UtilService::millisecond());
                Cache::forget($key);
                return UtilService::format_data(self::AJAX_SUCCESS, '秒杀成功', '');
            } else {
                return UtilService::format_data(self::AJAX_FAIL, '秒杀已结束', '');
            }
        }
        else{
            return UtilService::format_data(self::AJAX_NO_DATA, '非法操作', '');
        }
    }

    public function shareExecute(Request $request){
        $uid = $request->input('uid');
        $redis_name = 'share_key_' . $uid;

        while(Redis::lLen($redis_name) > 0){
            $user = Redis::lPop($redis_name);
            if(!$user){
                continue;
            }
            else{
                $user_arr = explode('%', $user);
                $data = array(
                    'uid' => $user_arr[0],
                    'timestamp' => $user_arr[1],
                );

                //判断是否在一个小时以内
                $time = (float)$data['timestamp'] + 60 * 60 * 1000;
                if($time >= UtilService::millisecond()){
                    //执行开锁指令

                    return UtilService::format_data(self::AJAX_SUCCESS, '执行成功', '');
                }
                else{
                    return UtilService::format_data(self::AJAX_NO_DATA, '钥匙已失效', '');
                }
            }
        }

        return UtilService::format_data(self::AJAX_SUCCESS, '队列已处理完', '');
    }
}
