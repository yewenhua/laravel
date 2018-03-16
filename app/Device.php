<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;  //添加软删除

class Device extends Model
{
    use SoftDeletes;
    protected  $table = 'devices';
    protected  $dates = ['deleted_at'];  //添加软删除

    public function getlist()
    {
        return DB::table('devices')->get();
    }

    public function getDataByOpenid($openid){
        return $this->where('openid', $openid)->get();
    }
}
