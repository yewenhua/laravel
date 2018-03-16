<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use UtilService;
use JWTAuth;
use Hash;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    const AJAX_SUCCESS = 0;
    const AJAX_FAIL = -1;
    const AJAX_NO_DATA = 10001;
    const AJAX_NO_AUTH = 99999;

    public function index(Request $request){
        $path = $request->input('path');
        $userObj = JWTAuth::parseToken()->authenticate();
        $permission = \App\Permission::where('desc', $path)->first();
        if ($permission && Gate::allows($path, $permission)) {
            $page = $request->input('page');
            $limit = $request->input('num');
            $search = $request->input('search');
            $offset = ($page - 1) * $limit;
            $like = '%' . $search . '%';

            $total = \App\User::where('name', 'like', $like)
                ->orderBy('id', 'desc')
                ->get();

            $users = \App\User::where('name', 'like', $like)
                ->orderBy('id', 'desc')
                ->offset($offset)
                ->limit($limit)
                ->get();

            if ($users) {
                $res = array(
                    'user' => $userObj,
                    'data' => $users,
                    'total' => count($total)
                );
                return UtilService::format_data(self::AJAX_SUCCESS, '获取成功', $res);
            } else {
                return UtilService::format_data(self::AJAX_FAIL, '获取失败', '');
            }
        }
        else{
            return UtilService::format_data(self::AJAX_NO_AUTH, '没有权限', '');
        }
    }

    public function create(){

    }

    public function store(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $desc = $request->input('desc');
        $this->validate(request(), [
            'name'=>'required|min:1',
            'desc'=>'required'
        ]);

        if($id){
            $user = \App\User::find($id);
            $user->name = $name;
            $user->desc = $desc;
            $res = $user->save();
        }
        else{
            $res = \App\User::create(request(['name', 'desc'])); //save 和 create 的不同之处在于 save 接收整个 Eloquent 模型实例而 create 接收原生 PHP 数组
        }

        if($res){
            return UtilService::format_data(self::AJAX_SUCCESS, '操作成功', $res);
        }
        else{
            return UtilService::format_data(self::AJAX_FAIL, '操作失败', '');
        }
    }

    //路由模型绑定user实例
    public function role(\App\User $user){
        $roles = \App\Role::all(); // all roles
        $myRoles = $user->roles; //带括号的是返回关联对象实例，不带括号是返回动态属性

        //compact 创建一个包含变量名和它们的值的数组
        $data = compact('roles', 'myRoles', 'role');
        return UtilService::format_data(self::AJAX_SUCCESS, '获取成功', $data);
    }

    //储存用户角色
    public function storeRole(\App\User $user){
        //验证
        $roles = \App\Role::findMany(request('roles'));
        $myRoles = $user->roles;

        //要增加的角色
        $addRoles = $roles->diff($myRoles);
        foreach ($addRoles as $role){
            $user->assignRole($role);
        }

        //要删除的角色
        $deleteRoles = $myRoles->diff($roles);
        foreach ($deleteRoles as $role){
            $user->deleteRole($role);
        }

        return UtilService::format_data(self::AJAX_SUCCESS, '保存成功', []);
    }

    public function delete(Request $request){
        $id = $request->input('id');
        $this->validate(request(), [
            'id'=>'required|min:1'
        ]);

        $user = \App\User::find($id);
        $res = $user->delete();
        if($user && $res){
            return UtilService::format_data(self::AJAX_SUCCESS, '操作成功', $res);
        }
        else{
            return UtilService::format_data(self::AJAX_FAIL, '操作失败', '');
        }
    }

    public function chgpwd(Request $request){
        $id = $request->input('id');
        $oldpwd = $request->input('oldpwd');
        $newpwd = $request->input('newpwd');
        $this->validate(request(), [
            'id'=>'required',
            'oldpwd'=>'required|min:1',
            'newpwd'=>'required'
        ]);

        $user = JWTAuth::parseToken()->authenticate();
        if($user && $user->id == $id){
            $flag = Hash::check($oldpwd, $user->password);
            if($flag) {
                $user->password = bcrypt($newpwd);
                $res = $user->save();
                if ($res) {
                    return UtilService::format_data(self::AJAX_SUCCESS, '操作成功', $res);
                } else {
                    return UtilService::format_data(self::AJAX_FAIL, '操作失败', '');
                }
            }
            else{
                return UtilService::format_data(self::AJAX_FAIL, '原密码错误', '');
            }
        }
        else{
            return UtilService::format_data(self::AJAX_FAIL, '用户错误', '');
        }
    }
}
