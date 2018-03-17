<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use WechatService;   //引入 WechatService 门面
use Illuminate\Support\Facades\Cache;
use UtilService;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;
use App\Document;

class VocController extends Controller
{

    public $bace_url = 'https://iot-app.ouganyun.com/v1';
    public $auth_url = 'https://iot-app.ouganyun.com';
    public $wxapiurl = '';

    const AJAX_SUCCESS = 0;
    const AJAX_FAIL = -1;
    const AJAX_NO_DATA = 10001;
    const AJAX_NO_AUTH = 99999;

    public function __construct()
    {
        $wxapiurl = config('wechat.wxapiurl');
        $this->wxapiurl = $wxapiurl;
    }

    public function index()
    {
        return view('voc');
    }

    public function question()
    {
        $data = array();
        $data['wxapiurl'] = $this->wxapiurl;
        return view('question', $data);
    }

    public function zhaopin()
    {
        $data = array();
        $data['wxapiurl'] = $this->wxapiurl;
        return view('zhaopin', $data);
    }

    public function download()
    {
        $data = array();
        $data['wxapiurl'] = $this->wxapiurl;
        return view('download', $data);
    }

    public function tiaoma()
    {
        $data = WechatService::jsapi();
        $data['wxapiurl'] = $this->wxapiurl;
        return view('tiaoma', $data);
    }

    public function install()
    {
        $data = WechatService::jsapi();
        $data['wxapiurl'] = $this->wxapiurl;
        return view('install', $data);
    }

    public function baoxiu()
    {
        $data = WechatService::jsapi();
        $data['wxapiurl'] = $this->wxapiurl;
        return view('baoxiu', $data);
    }

    public function comment()
    {
        $data = WechatService::jsapi();
        $data['wxapiurl'] = $this->wxapiurl;
        return view('comment', $data);
    }

    public function baoxiu_service()
    {
        $data = WechatService::jsapi_service();
        $data['wxapiurl'] = $this->wxapiurl;
        return view('baoxiu', $data);
    }

    public function comment_service()
    {
        $data = WechatService::jsapi_service();
        $data['wxapiurl'] = $this->wxapiurl;
        return view('comment', $data);
    }

    public function navigate()
    {
        $data['wxapiurl'] = $this->wxapiurl;
        return view('navigate', $data);
    }

    public function number()
    {
        $data = array();
        return view('number', $data);
    }

    //小程序保存个人多媒体信息
    public function savefile(Request $request)
    {
        $label = $request->input('label');
        $ftype = $request->input('ftype');
        $file = $request->file('file');
        $name = date('Ymd');
        $path = $file->store($name,'uploads');
        $obj = new Document();
        $obj->label = $label;
        $obj->type = $ftype;
        $obj->path = '/uploads/'.$path;

        if($ftype == 'audio'){
            $time = $request->input('time');
            $obj->time = $time;
        }
        $bool = $obj->save();

        if($bool) {
            return UtilService::format_data(self::AJAX_SUCCESS, '保存成功', [
                "path" => $path
            ]);
        }
        else{
            return UtilService::format_data(self::AJAX_FAIL, '保存失败', []);
        }
    }

    //小程序获取个人多媒体信息
    public function documents(Request $request)
    {
        $searchkey = $request->input('searchkey');
        $ftype = $request->input('ftype');
        $page = $request->input('page');
        $size = $request->input('size');
        $offset = ($page - 1) * $size;

        $count = Document::where('label', 'like', '%'.$searchkey.'%')->where('type', $ftype)->count();
        $documents = Document::where('label', 'like', '%'.$searchkey.'%')
            ->where('type', $ftype)
            ->orderBy('id', 'desc')
            ->offset($offset)
            ->limit($size)
            ->get();

        if(!$documents->isEmpty()){
            return UtilService::format_data(self::AJAX_SUCCESS, '获取成功', [
                "count" => $count,
                "data" => $documents
            ]);
        }
        else{
            return UtilService::format_data(self::AJAX_FAIL, '获取失败', []);
        }
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
                "expires_in" => 3600
            );

            if (Cache::has($key)) {
                Cache::forget($key);
            }

            //将session_key写进缓存
            $res = Cache::add($key, $param, 60 * 6);
            if ($res) {
                return UtilService::format_data(self::AJAX_SUCCESS, '操作成功', ['third_session'=>$third_session]);
            } else {
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
    private function getSessionByKey($third_session) {
        $res = Cache::get($third_session);
        if($res){
            return $res;
        }
        else{
            return null;
        }
    }

    //通过openid登录
    public function signinByOpenid(Request $request)
    {
        $key = $request->input('third_session');
        $info = $this->getSessionByKey($key);
        $openid = $info['openid'];
        $session_key = $info['session_key'];

        //1、通过openid 判断是否绑定
        //2、未绑定时 返回未绑定信息 前台跳转到登录页面，传递用户名密码、third_session到后台绑定并登录
        //3、已绑定 直接返回登录信息

        if($openid) {
            $res = $this->checkByOpenid($openid);
            if (isset($res['type']) && $res['type'] == 'SUCCESS') {
                //已绑定
                return UtilService::format_data(self::AJAX_SUCCESS, '登录成功', $res['data']);
            } else {
                //未绑定
                return UtilService::format_data(self::AJAX_FAIL, '账号未绑定', '');
            }
        }
        else{
            //session失效
            return UtilService::format_data(self::AJAX_NO_DATA, 'session失效', '');
        }
    }

    //通过openid 判断是否绑定
    private function checkByOpenid($openid){
        $data = array(
            "diy_header" => 'Content-Type: application/x-www-form-urlencoded; charset=utf-8'
        );

        $url = $this->auth_url. '/oauth/token?client_id=e41df05b-f963-4a66-a8cd-8596d1564fee&client_secret=3ca4b24f-d2cd-44cc-b5c9-31f88c7c5631&grant_type=openid&scope=read,write&openid='.$openid;
        $result = UtilService::curl_post($url, $data);
        return $result;
    }

    //点击分享按钮回调打开分享标签
    public function shareBegin(Request $request){
        $access_token = $request->input('access_token');
        $share = $request->input('share');
        $key = md5('share_'.$access_token.'_'.$share);
        $param = array(
            'access_token'=>$access_token,
            'share'=>$share
        );
        if (Cache::has($key)) {
            return UtilService::format_data(self::AJAX_SUCCESS, '分享成功', '');
        }
        else{
            $res = Cache::add($key, $param, 60); //1h
            if ($res) {
                return UtilService::format_data(self::AJAX_SUCCESS, '分享成功', '');
            } else {
                return UtilService::format_data(self::AJAX_FAIL, '分享失败', '');
            }
        }
    }

    public function shareOpen(Request $request){
        $access_token = $request->input('access_token');
        $share = $request->input('share');
        $key = md5('share_'.$access_token.'_'.$share);
        $res = Cache::get($key);
        if($res) {
            $redis_name = 'share_key_' . $access_token.'_'.$share;

            if (Redis::lLen($redis_name) < 1) {
                Redis::rPush($redis_name, $access_token . '%' . UtilService::millisecond());
                Cache::forget($key);

                //执行队列结果, 100毫秒后再读取队列, 防止并发
                usleep(100000);
                $user = Redis::lPop($redis_name);
                $user_arr = explode('%', $user);
                $data = array(
                    'token' => $user_arr[0],
                    'timestamp' => $user_arr[1],
                );

                if($data['token'] == $access_token){
                    return UtilService::format_data(self::AJAX_SUCCESS, '获取分享成功', '');
                }
                else{
                    return UtilService::format_data(self::AJAX_FAIL, '获取分享失败', '');
                }
            } else {
                return UtilService::format_data(self::AJAX_FAIL, '获取分享失败', '');
            }
        }
        else{
            return UtilService::format_data(self::AJAX_NO_DATA, '非法操作', '');
        }
    }

    public function flush(){
        Cache::forget('3dc1f2d8e11768b007bb363707f02f88');
        return UtilService::format_data(self::AJAX_SUCCESS, '操作成功', []);
    }

    public function share(){
        $data = array();
        return view('share', $data);
    }

}
