<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;

class Info extends Moloquent
{
    protected $collection = 'info';
    protected $fillable = [
        'name',
        'email',
        'description'
//        'github',
//        'weibo',
//        'facebook',
//        'zhihu'
    ];
    protected $connection = 'mongodb';
    protected $primaryKey = '_id';
}
