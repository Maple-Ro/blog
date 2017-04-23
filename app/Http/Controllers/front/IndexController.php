<?php
/**
 * Created by PhpStorm.
 * User: stanley
 * Date: 2017/3/20 0020
 * Time: 9:36
 */

namespace app\Http\Controllers\front;


use App\Http\Controllers\Controller;
use App\Model\Article;
use Illuminate\View\View;

class IndexController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return $this->showList('/article', 1);
    }

    function list(int $page): View
    {
        return $this->showList('/article', $page);
    }

    private function showList(string $url, int $page, int $limit = 6): View
    {
        $total = Article::count('_id') / $limit + 1;
        $data = Article::forPage($page, $limit)->get();
        $links = pagination($url, $page, $total);
        return frontView('content')->with(compact(['data', 'links']));
    }

    function detail(string $id)
    {
        $data = Article::find($id);
        if (empty($data)) {
            abort(404);
        }
            return frontView('detail')->with(compact(['data']));
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