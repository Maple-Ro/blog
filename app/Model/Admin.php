<?php
/**
 * Created by PhpStorm.
 * User: stanley
 * Date: 2017/4/19 0019
 * Time: 10:32
 */

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Admin extends Moloquent
{
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'admin';
    protected $primaryKey = '_id';
    protected $dates = ['deleted_at'];
}