<?php

namespace App\Http\Controllers;

use App\Jobs\SendMail;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Post;
use App\Group;
use Illuminate\Support\Facades\Log;
use Mail;
use Illuminate\Support\Facades\Cache;
use App\Order;
use App\Events\OrderShipped;
use GatewayClient\Gateway;
use Illuminate\Support\Facades\Auth;
use App\Miaosha;
use Illuminate\Support\Facades\Redis;
use WxpayService;   //引入 WxpayService 门面
use UtilService;

class MemberController extends Controller{

    const AJAX_SUCCESS = 0;
    const AJAX_FAIL = -1;
    const AJAX_NO_DATA = 10001;
    const AJAX_NO_AUTH = 99999;

    public function info(){
        return Member::getMember();
    }

    /*
     * db facade使用
     */
    public function query(){
        $members = DB::select('select * from member');
        var_dump($members);
    }

    public function add(){
        $bool = DB::insert('insert into member(name, age, sex) values(?, ?, ?)', ['cat', 18, 1]);
        var_dump($bool);
    }

    public function update(){
        $num = DB::update('update member set name = ? where id = ?', ['dog', 1]);
        var_dump($num);
    }

    public function delete(){
        $num = DB::update('delete from member where id = ?', [1]);
        var_dump($num);
    }


    /*
     * 构造器使用
     */
    public function query2(){
        $members = DB::table('member')->where('id', '>=', 2)->get();
        var_dump($members);
    }

    public function query3(){
        $members = DB::table('member')->first();
        var_dump($members);
    }

    public function query4(){
        $members = DB::table('member')->orderBy('id', 'desc')->first();
        var_dump($members);
    }

    /*
     * 多条件查询
     */
    public function query5(){
        $members = DB::table('member')->whereRaw('id >= ? and age >= ?', [2, 15])->get();
        var_dump($members);
    }

    public function query6(){
        $nums = DB::table('member')->count();
        var_dump($nums);
    }

    public function add2(){
        $bool = DB::table('member')->insert([
            'name' => 'cat',
            'age' => 21,
            'sex' => 0
        ]);
        var_dump($bool);
    }

    public function add3(){
        $id = DB::table('member')->insertGetId([
            'name' => 'tiger',
            'age' => 21,
            'sex' => 0
        ]);
        var_dump($id);
    }

    public function add4(){
        $bool = DB::table('member')->insert([
            ['name' => 'rabbit', 'age' => 88, 'sex' => 1],
            ['name' => 'dog', 'age' => 66, 'sex' => 0],
        ]);
        var_dump($bool);
    }

    public function update2(){
        $num = DB::table('member')
            ->where('id', 2)
            ->update(['sex' => 0]);
        var_dump($num);
    }

    public function update3(){
        $num = DB::table('member')
            ->where('id', 2)
            ->decrement('age', 2, ['name'=> 'hello']);
        var_dump($num);
    }

    public function delete2(){
        $num = DB::table('member')
            ->where('id', 2)
            ->delete();
        var_dump($num);
    }

    public function delete3(){
        $num = DB::table('member')
            ->where('id', '>=', 5)
            ->delete();
        var_dump($num);
    }

    public function orm1(){
        $members = Member::all();
        dd($members);
    }

    public function orm2(){
        $members = Member::find(3);
        dd($members);
    }

    public function orm3(){
        $members = Member::findOrFail(3);
        dd($members);
    }

    public function orm4(){
        $members = Member::where('id', '>', 3)->get();
        dd($members);
    }

    public function orm5(){
        $member = new Member();
        $member->name = 'world';
        $member->age = 50;
        $member->sex = 1;
        $bool = $member->save();
        var_dump($bool);
    }

    public function orm6(){
        $member = Member::create([
            'age'=> 15,
            'name'=>'Kitty',
            'sex'=>0
        ]);
        var_dump($member);
    }

    public function orm7(){
        $members = Member::find(3);
        $members->age = 99;
        $bool = $members->save();
        var_dump($bool);
    }

    public function orm8(){
        $members = Member::find(3);
        $bool = $members->delete();
        var_dump($bool);
    }

    public function orm9(){
        $num = Member::destroy();
        var_dump($num);
    }


    public function request(Request $request){
        //echo $request->input('name', 'hello');
        if($request->has('name')){
            echo 'OK';
        }
        else{
            echo 'FAIL';
        }

        //$all_param = $request->all();
        //dd($all_param);

        //$method = $request->method();

        if($request->isMethod('GET')){
            echo 'yes';
        }
        else{
            echo 'no';
        }

        //$request->ajax();
        //$request->is('member/*');  //某个控制器下
    }

    public function session(Request $request){
        //1、http request session
        //$request->session()->put('name', 'cat');
        //echo $request->session()->get('name');

        //2、session()
        //session()->put('name', 'dog');
        //echo session()->get('name');

        //3、Session类
        //Session::put('name', 'tiger');
        //echo Session::get('name');
    }

    public function session2(Request $request){
        //echo $request->session()->get('name');
        //echo session()->get('name');
        //echo Session::get('name');

        //Session::has('user');
        //Session::forget('key');
        //Session::flush();
        //Session::flash('key', 'value');
    }

    public function response(){
        $data = array(
            'code'=>0,
            'data'=>'',
            'msg'=>''
        );

        //重定向
        //return redirect('session');
        //return redirect('session')->with('message', 'hello');  //对应页面获取为Session::get('message', 'default') ,只显示一次，相当于flash message
        //return redirect()->route('session')->with('message', 'hello');
        //return redirect()->back();
        return response()->ajax($data);
    }

    public function activity0(){
        return '活动就要开始啦，尽情期待！';
    }

    public function activity1(){
        return '活动正在进行中，欢迎您的到来';
    }

    public function activity2(){
        return '活动已经结束啦';
    }

    public function relation(){
        //一对一
        //$user = User::find(1);
        //$userinfo = $user->userinfo;
        //dd($userinfo);

        //一对多
        //$user = User::find(1);
        //$posts = $user->posts()->where('id', 1)->get();
        //$posts = $user->posts;
        //dd($posts);

        //一对多写入
        //$user = User::find(1);
        //$post = new Post();
        //$post->title = 'hello';
        //$post->content = 'kitty';
        //$user->posts()->save($post);

        //属于关系
        //$user = User::find(1);
        //$country = $user->country;
        //dd($country);

        //多对多
        //$user = User::find(1);
        //$group = $user->group;
        //dd($group);

        //多对多创建
        $user = User::find(3);
        //$group = Group::find(3);
        //$user->group()->attach($group); //这里既可以放组ID也可以放对象
        //$user->group()->detach($group); //删除
        $user->group()->sync([1, 2, 3]);  //同步
    }

    public function log(){
        Log::info('hello world');
    }

    public function mail(){
        //文本邮件
        /*
        Mail::raw('邮件内容', function($message){
            $message->from('ye_goodluck@aliyun.com', 'cat');
            $message->subject('have a rest');
            $message->to('2574522520@qq.com');
        });
        */

        //模板邮件
        Mail::send('mail', ['name'=>'kitty'], function($message){
            $message->from('ye_goodluck@aliyun.com', 'cat');
            $message->subject('have a template');
            $message->to('2574522520@qq.com');
        });
    }

    /**
     * 1、php artisan queue:table  php artisan queue:failed-table   手动删除migrate文件后运行composer dump-autoload，可重新生成migrate文件
     * 2、php artisan migrate
     * 3、php artisan make:job SendMail
     * 4、调用控制器queue方法推送到队列
     * 5、php artisan queue:listen
     */
    public function queue(){
        dispatch(new SendMail('2574522520@qq.com'));
    }

    public function cache(){
        $value = Cache::remember('users', 60, function () {
            //60 mins
            return DB::table('users')->get();
        });

        return response()->json($value);
    }

    public function users(){
        $value = DB::table('users')->get();

        return response()->json($value);
    }

    public function event(){
        $orderId = '201707145141';
        $order = Order::firstOrCreate(['order_id' => $orderId, 'status' => 1]);

        // 订单的发货逻辑...

        //触发事件
        event(new OrderShipped($order));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 广播链接页面
     */
    public function broadcast(){
        return view('broadcast');
    }

    /**
     * 后端推送广播
     */
    public function send(){
        $user = Auth::user();
        $userData = $user['attributes'];
        Gateway::$registerAddress = '127.0.0.1:1236';
        $data = array(
            'type' => 'say',
            'content' => 'hello world',
            'from_client_name' => 'server',
            'from_client_id' => 9999,
            'time' => date('Y-m-d H:i:s', time())
        );
        //Gateway::sendToAll(json_encode($data));
        Gateway::sendToGroup(1, json_encode($data));

        $uid = $userData['id'];
        $group = $userData['id'];
        // 向任意uid的网站页面发送数据
        $data['content'] = 'kitty';
        Gateway::sendToUid($uid, json_encode($data));
        // 向任意群组的网站页面发送数据
        $data['content'] = 'go go go';
        Gateway::sendToGroup($group, json_encode($data));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * mvc后端uid绑定socket  client_id
     */
    public function bind(Request $request){
        $client_id = $request->input('client_id');
        $group_id = $request->input('group_id');
        // 设置GatewayWorker服务的Register服务ip和端口，请根据实际情况改成实际值
        Gateway::$registerAddress = '127.0.0.1:1236';

        $user = $request->user();
        // client_id与uid绑定
        Gateway::bindUid($client_id, $user->id);
        // 加入某个群组（可调用多次加入多个群组）
        Gateway::joinGroup($client_id, $group_id);

        $rtn = array("code"=>0, "msg"=>"success", "uid"=>$user->id);
        return response()->json($rtn);
    }

    /**
     * 秒杀，调用redis原始方法 需要use Redis
     */
    public function miaosha(){
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        $redis_name = 'miaosha';

        for($i=0; $i<100; $i++){
            $uid = rand(10000, 99999);
            $num = 10;

            if($redis->LLEN($redis_name) < 10){
                $redis->rPush($redis_name, $uid.'%'.microtime());
                echo $uid.'秒杀成功';
            }
            else{
                echo '秒杀已结束';
            }
        }
        $redis->close();
    }

    /*
     * php artisan make:migration create_miaosha_table
     * php artisan migrate
     */
    public function success(){
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        $redis_name = 'miaosha';

        while($redis->LLEN($redis_name) > 0){
            $user = $redis->lPop($redis_name);
            if(!$user){
                continue;
            }
            else{
                $user_arr = explode('%', $user);
                $data = array(
                    'uid' => $user_arr[0],
                    'timestamp' => $user_arr[1],
                );

                $res = Miaosha::firstOrCreate($data);
                if(!$res){
                    $redis->rPush($redis_name, $user);
                }
            }
        }
        echo '队列已处理完';

        $redis->close();
    }

    public function second(){
        $redis_name = 'second';

        for($i=0; $i<100; $i++){
            $uid = rand(10000, 99999);
            $num = 10;

            if(Redis::lLen($redis_name) < 10){
                Redis::rPush($redis_name, $uid.'%'.microtime());
                echo $uid.'秒杀成功';
            }
            else{
                echo '秒杀已结束';
            }
        }
    }

    public function process(){
        $redis_name = 'second';

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

                $res = Miaosha::firstOrCreate($data);
                if(!$res){
                    Redis::rPush($redis_name, $user);
                }
            }
        }
        echo '队列已处理完';
    }

    public function service(){
        //静态方式调用
        return WxpayService::notify();
    }

    /*
     * api接口，需使用https协议
     * $param username
     * $param password
     * @return uid & token
     */
    public function signin(){
        //……其他操作
        $uid = md5(9999);
        $token = md5(8888);
        $key = md5($token.'hello');
        $res = Cache::add($key, $uid, 60); //1h
        if($res){
            return UtilService::format_data(self::AJAX_SUCCESS, '登录成功', [
                "uid" => $uid,
                "token" => $token
            ]);
        }
        else{

        }
    }

    /*
     * url请求拦截规则
     * 1、验证时间戳是否有效期内
     * 2、缓存中是否有UID与token对应
     * 3、按字典序排序参数
     * 4、请求参数合成字符串
     * $param为请求参数
     * $token和$uid通过https协议后的登录操作获取，然后保存在客户端
     * 用户退出登录时清空token
     * 参数里添加uid和timestamp uid后台获取token timestamp验证时效
     */
    public function check_query($param, $urlencode=false)
    {
        //添加时间戳，隔太久失效，防止被截取重复调用
        if((time() - $param['timestamp'] ) <= 60){
            $key = md5($param['token'].'hello');
            $uid = Cache::get($key);
            if($uid){
                $buff = "";
                //签名步骤一：按字典序排序参数
                ksort($param);
                $buff = $this->ToUrlParams($param);

                $string = '';
                if (strlen($buff) > 0)
                {
                    $string = $buff;
                    //签名步骤二：在string后加入KEY
                    $pub_key = '123456789';
                    $string = $string."&key=".$pub_key;
                    //签名步骤三：MD5加密
                    $string = md5($string);
                    //签名步骤四：所有字符转为大写
                    $res_sign = strtoupper($string);
                    if($param['sign'] == $res_sign){
                        //right
                    }
                    else{
                        //wrong
                    }
                }
                else{
                    //param w
                }
            }
            else{
                //token fail
            }
        }
        else{
            //timeout
        }
    }

    protected function ToUrlParams($urlObj)
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

    //通过两地经纬度获得两地之间的距离，单位米
    public function distance(){
        $key = '32a7b5ccd33e2feca49773d5f6d12d96';
        $origins = '116.481028,39.989643';
        $destination = '114.465302,40.004717';
        $url = 'http://restapi.amap.com/v3/distance?origins='.$origins.'&destination='.$destination.'&key='.$key;
        $res = UtilService::curl_get($url);
        if($res['status'] == 1){
            $results = $res['results'][0];
            return array(
                "distance"=>$results['distance'],
                "duration"=>$results['duration']
            );
        }
        else{
            return 'fail';
        }
    }

    public function location(){
        $key = '32a7b5ccd33e2feca49773d5f6d12d96';
        $address = '北京市朝阳区阜通东大街6号';
        $url = 'http://restapi.amap.com/v3/geocode/geo?address='.$address.'&key='.$key;
        $res = UtilService::curl_get($url);
        if($res['status'] == 1){
            $location = $res['geocodes'][0]['location'];
            $location_array = explode(',', $location);
            return array(
                "longitude"=>$location_array[0],
                "latitude"=>$location_array[1]
            );
        }
        else{
            return 'fail';
        }
    }
}