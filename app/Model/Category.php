<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Category extends Moloquent
{
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'category';
    protected $primaryKey = '_id';
    protected $dates = ['deleted_at'];
}