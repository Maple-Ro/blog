<?php
/**
 * Created by PhpStorm.
 * User: stanley
 * Date: 2017/4/6 0006
 * Time: 21:00
 */

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

/**
 * 文章Model
 * Class Article
 * 使用软删除
 * @package App\Model
 */
class Article extends Moloquent
{
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'article';
    protected $primaryKey = '_id';
    protected $dates = ['deleted_at'];
    //关键字段
    //content(string), title(string), label([string])
}