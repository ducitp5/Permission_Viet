<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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
        $this->middleware('auth')->except(['request']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->middleware('auth');
        
        return      view('home');
    }

    public function session()
    {
        dd(session()->all());
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
