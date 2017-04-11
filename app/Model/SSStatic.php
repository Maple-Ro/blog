<?php
/**
 * Created by PhpStorm.
 * User: stanley
 * Date: 2017/4/11 0011
 * Time: 17:27
 */

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;

class SSStatic extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'ssstatic';
    protected $primaryKey = '_id';
}