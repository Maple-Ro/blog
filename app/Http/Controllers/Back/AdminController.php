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
        if ($res) {
            return json_encode([
                'status' => 200,
                'success' => true
            ]);
        } else {
            return json_encode([
                'status' => 401,
                'error' => 'operation error!'
            ]);
        }
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
        $name = trim($request->username);
        $pwd = trim($request->password);

        try {
            $hashed_pwd = Admin::where('name', $name)->first()->pwd;
            $res = Hash::check($pwd, $hashed_pwd);
            if ($res) {
                return json_encode([
                    'status' => 200,
                    'username' => $name,
                    'success' => true
                ]);
            } else {
                return json_encode([
                    'status' => 401,
                    'msg' => 'password is wrong!'
                ]);
            }
        } catch (\Exception $e) {
            return json_encode([
                'status' => 401,
                'msg' => 'username is not exists!'
            ]);
        }
    }

    /**
     * 修改密码
     * @param Request $request
     */
    function edit(Request $request)
    {

    }

    function info(): string
    {
        $data = ['info' => 'welcome'];

        return json_encode(['data' => $data, 'status' => 200, 'success' => true]);
    }

    function logout()
    {
        return successWithoutData();
    }
}