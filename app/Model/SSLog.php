<?php
/**
 * Created by PhpStorm.
 * User: stanley
 * Date: 2017/4/11 0011
 * Time: 10:33
 */

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;

class SSLog extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'sslog';
    protected $primaryKey = '_id';
}