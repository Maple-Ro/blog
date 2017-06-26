<?php
/**
 * Description:
 * User: Endless
 * Date: 2017/6/26
 * Time: 01:41
 */

namespace App\Http\Middleware;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class CheckToken
{
    public function handle($request, \Closure $next)
    {
        dd($request->header());
        $token = $request->header('Authorization');
        JWT::decode($token, \Yaconf::get("blog.token"), ['HS256']);
        return $next($request);
    }

    public function terminate($request, $response)
    {
    }
}