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
//        dd($_COOKIE['usercookie']);
        
//        dd(session('user'));
        
        if(session('user')){
            
            return      $next($request);
        }

        if(isset($_COOKIE['usercookie'])){
            
            Session::put( 'user' , json_decode($_COOKIE['usercookie']) );
            
            return      $next($request);
        }
        
        Session::flash('message', "you must login to continue");
        
        return      redirect()->route('login2');

//        return      abort(402);

    }
}
