<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\Auth;

class SpatieAuthController extends Controller
{
    private $rules  = [
        'name'          =>'required|min:2|max:255',
        'email'         =>'required|email|min:2|max:255',
        
        'password'      => 'required|min:2'
    ];
   
    private $messages   = [
        
        'name.min'          => 'Name phai tu 2 ky tu',
        'email.required'    => 'Email là trường bắt buộc',
        'email.email'       => 'Email không đúng định dạng',
        'password.required' => 'Mật khẩu là trường bắt buộc',
        'password.min'      => 'Mật khẩu phải chứa ít nhất 2 ký tự',
    ];
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct(User $user)
    {
        $this->user         =   $user;
        
//        $this->middleware('auth')->except(['request']);
    }    
    
    
    public function index3()
    {
        return      view('home');
    }
    
    
    public function login3()
    {
        if (session('link')) {
            
            if (url()->previous() == url('/login2')) {
                
                session(['link' => session('link')]);
            }
            else {
                
                session(['link' => url()->previous()]);
            }
        }
        else{
            
            session(['link' => url()->previous()]);
        }
        
        return      view('Spatieauth.login');
    }
    
    
    public function loginning3(Request $request)
    {
        $user      =   User ::where('email'       ,   $request->email)
                            ->where('password'    ,   md5($request->password))    ->first();
                
        if($user){
            
            $locale     =   Session::get('link');
            $comeback   =   Session::get('comeback');
            Session::flush();
            
            unset($_COOKIE['usercookie']);
            
            if($request->remember){
                
                setcookie('usercookie', $user, time() + (24*60*60 * 30), "/");
            }
            else{
                
                Session::put('user' ,   $user);
            }
            
            Session::put('layout'   , '3');
            Session::put('link'     , $locale);
            Session::put('comeback' , $comeback);
            
            if(session('link') && session('comeback'))          return      redirect(session('link'));
            
            else                                                return      redirect()->route('home3');
        }
        else{
            
            $user      =   User ::where('email'   ,   $request->email)  ->first();
            
            if($user){
                
                session()->flash('errorLogin' , 'pass ko dung');
                
                return      redirect()->back();
            }
            else{
                session()->flash('errorLogin' ,  $request->email .' ko ton tai');
                
                return      redirect()->back();
            }
        }
    }
}
