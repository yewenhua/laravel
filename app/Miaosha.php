<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Miaosha extends Model
{
    protected  $table = 'miaosha_queue';
    protected $fillable = ['uid', 'timestamp'];
    public $timestamps = false;
}
