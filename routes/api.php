<?php

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['namespace' => 'API', 'middleware'=>['cros']], function () {
    Route::post('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout');
    Route::post('register', 'AuthController@register');

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('data', function () {
            // Just acting as a ping service.
            return response()->json(['data' => '9999'], 200);
        });
    });
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['jwt.auth', 'permission']], function () {
    //用户
    Route::get('admins', 'AdminController@index'); //用户列表页
    Route::get('admins/create', 'AdminController@create'); //用户创建页
    Route::post('admins/store', 'AdminController@store'); //创建用户保存
    Route::get('admins/{user}/role', 'AdminController@role');  //用户角色页   路由模型绑定
    Route::post('admins/{user}/role', 'AdminController@storeRole'); //保存用户角色页   路由模型绑定
    Route::post('admins/delete', 'AdminController@delete');
    Route::post('admins/chgpwd', 'AdminController@chgpwd');


    //角色
    Route::get('roles', 'RoleController@index');   //列表展示页面
    Route::get('roles/create', 'RoleController@create'); //创建页面
    Route::post('roles/store', 'RoleController@store'); //创建提交页面
    Route::get('roles/{role}/permission', 'RoleController@permission'); //角色权限页面  路由模型绑定
    Route::post('roles/{role}/permission', 'RoleController@storePermission'); //角色权限提交页面  路由模型绑定
    Route::post('roles/delete', 'RoleController@delete');


    //权限
    Route::get('permissions', 'PermissionController@index');
    Route::get('permissions/create', 'PermissionController@create');
    Route::post('permissions/store', 'PermissionController@store');
    Route::post('permissions/delete', 'PermissionController@delete');

    Route::get('allpermissions', 'PermissionController@permissions');
});

//小程序保存个人多媒体信息
Route::post('savefile', 'VocController@savefile');
Route::post('documents', 'VocController@documents');

//小程序开锁
Route::post('directive', 'VocController@directive');
Route::post('sendresult', 'VocController@sendresult');

Route::group(['namespace' => 'API'], function () {
    Route::get('auth/refresh', 'AuthController@refresh');
});

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::get('admins/info', 'AdminController@userInfo');
});