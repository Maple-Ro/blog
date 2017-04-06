<?php
/**
 * Created by PhpStorm.
 * User: stanley
 * Date: 2017/4/6 0006
 * Time: 21:00
 */

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;

/**
 * 文章
 * Class Article
 * @package App\Model
 */
class Article extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'article';
    protected $primaryKey = '_id';
}

//单条文章存储数据格式：
//    {
//        "code": 200,
//    "data": [
//        {
//            "content": "0",
//            "date": "2017-03-22",
//            "day": "2017-03-22",
//            "id": 1,
//            "title": "我的标题",
//            "weekday": "wed",
//            "year": "2017"
//        }
//    ],
//    "msg": "",
//    "status": "success"
//}