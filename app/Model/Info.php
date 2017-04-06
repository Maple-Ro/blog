<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;

/**
 * 测试用
 * Class Info
 * @package App\Model
 */
class Info extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'info';
    protected $primaryKey = '_id';
    protected $fillable = [
        'name',
        'email',
        'description'
//        'github',
//        'weibo',
//        'facebook',
//        'zhihu'
    ];

}

