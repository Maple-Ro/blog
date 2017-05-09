<?php
/**
 * Created by PhpStorm.
 * User: stanley
 * Date: 2017/5/9 0009
 * Time: 15:19
 */

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;

class SSD extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'shadowsocks_date_log';
    protected $primaryKey = '_id';
}