<?php
/**
 * Created by PhpStorm.
 * User: stanley
 * Date: 2017/4/13 0013
 * Time: 16:09
 */

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

/**
 * React Curd Demo示例后台模型
 * Class ReactDemo
 * @package app\Model
 */
class ReactDemo extends Moloquent
{
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'reactdemo';
    protected $primaryKey = '_id';
    protected $dates = ['deleted_at'];
}