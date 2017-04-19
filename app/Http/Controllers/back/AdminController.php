<?php
/**
 * Created by PhpStorm.
 * User: stanley
 * Date: 2017/4/19 0019
 * Time: 10:32
 */

namespace App\Http\Controllers\Back;


use App\Http\Controllers\Controller;
use App\Model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * 注册页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|mixed
     */
    function index()
    {
        return backView('page.register');
    }

    /**
     * 用户注册
     * @param Request $request
     * @return string
     */
    function register(Request $request): string
    {
        $admin = new Admin();
        $admin->name = trim($request->name);
        $admin->pwd = Hash::make(trim($request->pwd));
        $res = $admin->save();
        return $this->echo($res);
    }

    function login()
    {
        return backView('page.login');
    }

    /**
     * 登陆验证
     * @param Request $request
     * @return string
     */
    function loginSubmit(Request $request): string
    {
        $name = trim($request->name);
        $pwd = trim($request->pwd);
        $hashed_pwd = Admin::where('name', $name)->first()->pwd;
        $res = Hash::check($pwd, $hashed_pwd);
        return $this->echo($res);
    }

    /**
     * 修改密码
     * @param Request $request
     */
    function edit(Request $request)
    {

    }

    /**
     * 公共输出
     * @param bool $result
     * @return string
     */
    private function echo (bool $result): string
    {
        if ($result) {
            return response()->json([
                'status' => 200
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'msg' => 'operation failed'
            ]);
        }
    }
}