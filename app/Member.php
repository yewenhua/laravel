<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model{
    protected  $table = 'member';
    protected  $primaryKey = 'id';

    //指定运行批量赋值的字段
    protected $fillable = ['age', 'name', 'sex'];

    public static function getMember(){
        return 'member name is cat';
    }
}