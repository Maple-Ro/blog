<?php
namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;
class BeforeAnyDbQueryMiddleware
{
    public function handle($request, \Closure $next)
    {
//        if (env('APP_ENV') === 'local') DB::enableQueryLog();
        return $next($request);
    }

    public function terminate($request, $response)
    {
        // Store or dump the log data...
//        if (env('APP_ENV') === 'local') dd(DB::getQueryLog());
    }
}