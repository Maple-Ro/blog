<?php
/**
 * Description:
 * User: Endless
 * Date: 2017/6/17
 * Time: 18:22
 */

namespace App\Http\Controllers\back;


use App\Http\Controllers\Controller;
use App\Model\Tags;

class TagsController extends Controller
{
    function __construct()
    {
        $this->middleware('token');
    }
    function list()
    {
        $tagsList = Tags::all()->toArray();
        return successWithData([
            'tagslist' => $tagsList
        ]);
    }
}