<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('member/info', 'MemberController@info');

Route::get('member/info', ['uses' => 'MemberController@info']);

Route::get('member/query', 'MemberController@query');
Route::get('member/add', 'MemberController@add');
Route::get('member/update', 'MemberController@update');
Route::get('member/delete', 'MemberController@delete');

Route::get('member/query2', 'MemberController@query2');
Route::get('member/query3', 'MemberController@query3');
Route::get('member/query4', 'MemberController@query4');
Route::get('member/query5', 'MemberController@query5');
Route::get('member/query6', 'MemberController@query6');
Route::get('member/add2', 'MemberController@add2');
Route::get('member/add3', 'MemberController@add3');
Route::get('member/add4', 'MemberController@add4');
Route::get('member/update2', 'MemberController@update2');
Route::get('member/update3', 'MemberController@update3');
Route::get('member/delete2', 'MemberController@delete2');
Route::get('member/delete3', 'MemberController@delete3');

Route::get('member/orm1', 'MemberController@orm1');
Route::get('member/orm2', 'MemberController@orm2');
Route::get('member/orm3', 'MemberController@orm3');
Route::get('member/orm4', 'MemberController@orm4');
Route::get('member/orm5', 'MemberController@orm5');
Route::get('member/orm6', 'MemberController@orm6');
Route::get('member/orm7', 'MemberController@orm7');
Route::get('member/orm8', 'MemberController@orm8');
Route::get('member/orm9', 'MemberController@orm9');


/*
 * 开启session start
 */
Route::group(['middleware'=>['web']], function(){
    Route::get('member/session', 'MemberController@session');
    Route::get('member/session2', 'MemberController@session2');
});


Route::get('member/request', 'MemberController@request');
Route::get('member/response', 'MemberController@response');



/*
 * 自定义中间件
 */
Route::any('member/activity0', 'MemberController@activity0');
Route::any('member/activity2', 'MemberController@activity2');
Route::group(['middleware'=>['activity']], function(){
    Route::any('member/activity1', 'MemberController@activity1');
});

Route::get('member/relation', 'MemberController@relation');
Route::get('member/log', 'MemberController@log');
Route::get('member/mail', 'MemberController@mail');
Route::get('member/queue', 'MemberController@queue');
Route::get('member/cache', 'MemberController@cache');
Route::get('member/event', 'MemberController@event');
Route::get('member/broadcast', 'MemberController@broadcast');
Route::get('member/send', 'MemberController@send');
Route::post('member/bind', 'MemberController@bind');
Route::get('member/miaosha', 'MemberController@miaosha');
Route::get('member/success', 'MemberController@success');
Route::get('member/second', 'MemberController@second');
Route::get('member/process', 'MemberController@process');
Route::get('member/users', 'MemberController@users');
Route::get('member/service', 'MemberController@service');


Route::get('voc/index', 'VocController@index');
Route::get('voc/wxlogin', 'VocController@wxlogin');
Route::get('voc/wxsignin', 'VocController@signinByOpenid');
Route::get('voc/bindwx', 'VocController@bindByOpenid');
Route::get('voc/keylist', 'VocController@keylist');
Route::get('voc/getkey', 'VocController@getkey');
Route::get('voc/flush', 'VocController@flush');
Route::get('voc/share', 'VocController@share');
Route::get('voc/sharebegin', 'VocController@shareBegin');
Route::get('voc/shareopen', 'VocController@shareOpen');
Route::get('voc/question', 'VocController@question');
Route::get('voc/download', 'VocController@download');
Route::get('voc/zhaopin', 'VocController@zhaopin');
Route::get('voc/tiaoma', 'VocController@tiaoma');
Route::get('voc/install', 'VocController@install');
Route::get('voc/baoxiu', 'VocController@baoxiu');
Route::get('voc/comment', 'VocController@comment');
Route::get('voc/baoxiu_service', 'VocController@baoxiu_service');
Route::get('voc/comment_service', 'VocController@comment_service');
Route::get('voc/navigate', 'VocController@navigate');
Route::get('voc/app', 'VocController@app');
Route::get('voc/scan', 'VocController@scan');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('fish', 'HomeController@maoxy');
Route::get('jpush', 'VocController@jpush');


Route::get('voc/number', 'VocController@number');
Route::get('member/distance', 'MemberController@distance');
Route::get('member/location', 'MemberController@location');


