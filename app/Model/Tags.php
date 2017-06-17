<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Tags extends Moloquent
{
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'tags';
    protected $primaryKey = '_id';
    protected $dates = ['deleted_at'];
}