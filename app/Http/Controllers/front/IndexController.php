<?php
/**
 * Created by PhpStorm.
 * User: stanley
 * Date: 2017/3/20 0020
 * Time: 9:36
 */

namespace app\Http\Controllers\front;


use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $r = $this->call('/web/article_list');
        if ($r->code != 200) {
            $data = [];
        } else {
            $data = $r->data;
        }
        return frontView('content')->with(compact(['data']));
    }

    public function test()
    {
        $seedData = [
            [
                'decade' => '1970s',
                'artist' => 'Debby Boone',
                'song' => 'You Light Up My Life',
                'weeksAtOne' => 10
            ],
            [
                'decade' => '1980s',
                'artist' => 'Olivia Newton-John',
                'song' => 'Physical',
                'weeksAtOne' => 10
            ],
            [
                'decade' => '1990s',
                'artist' => 'Mariah Carey',
                'song' => 'One Sweet Day',
                'weeksAtOne' => 16
            ]
        ];
        $uri = "mongodb://192.168.10.60";
        $client = new \MongoDB\Client($uri);
        $info = $client->db->info;
//        dd($info);
//        $info->insertMany($seedData);
//        $info->findOneAndUpdate([
//            'decade'=>'1970s'
//        ],[
//            '$set'=>[
//                'artist'=>'read'
//            ]
//        ]);
//        $info->findOneAndUpdate();
//        $res = $info->find();
//        return var_dump($res);
    }
}