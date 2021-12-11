<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use function PHPUnit\Framework\isJson;
//use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['request' , 'session']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        return      view('home');
    }
    
    public static function convertCookie($cookies)
    {
        $convert    =   Array();
        
        foreach ($cookies as $key => $val)
        {
            if(json_decode($val))    $convert[$key]  =   json_decode($val);
            
            else                     $convert[$key]  =   $val;
        }
        
        return  $convert;
    }
        
    public function session(Request $request)
    {
        $SessCook                       =   array();
                
        $SessCook['PHP_Cookies']        =   $_COOKIE;
        $SessCook['CookieConvert']      =   $this::convertCookie($_COOKIE);
        $SessCook['Laravel session']    =   session()->all();
        
        session_start();
        
        $SessCook['PHP_session']        =   $_SESSION;
        
        dd($SessCook);
        
//        dd(session());              //    Illuminate\Session\SessionManager
//        dd( new Session);           //    Illuminate\Support\Facades\Session 
//        dd( $request->session());   //    Illuminate\Session\Store
    }
    
    public function auth()
    {
        dd(Auth::user());
        dd(\Auth());
    }
    
    public function request(Request $request)
    {   
 //       dd($request);
 
        dd($request->expectsJson());
    }
}
