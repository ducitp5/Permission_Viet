<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;

class DucAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {  
//       dd($_COOKIE['usercookie']);
        if(session('user') || $_COOKIE['usercookie'])        return $next($request);
        
        return      redirect()->route('login2');

//        return      abort(402);

    }
}
