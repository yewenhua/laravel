<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    protected  $table = 'msg';
    protected $fillable = ['from_uid', 'to_uid', 'status', 'group_id']; //批量赋值
}
