<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;

class SpatieAuth
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
        if(session('user') && (session('layout') == '3') ){
            
            return      $next($request);
        }

        if(isset($_COOKIE['usercookie'])){
            
            Session::put( 'user' , json_decode($_COOKIE['usercookie']) );
            session('layout' , '3');
            
            return      $next($request);
        }
        
        Session::flash('message', "you must login to continue");
        
        return      redirect()->route('login3');
    }
}
