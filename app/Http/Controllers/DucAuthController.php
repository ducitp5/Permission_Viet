<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\Auth;

class DucAuthController extends Controller
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

    public function index2()
    {
        return      view('home');
    }
    
    public function register2()
    {        
        return      view('ducauth.register');
    }
    
    public function registing2(Request $request)
    {
 //       dd($request);
        
        $this->validate(    $request    ,   [
            
            $this->rules
        ]);
        
        $validator      =    Validator  ::make(  $request->all()    ,   $this->rules   ,   $this->messages  );
        
        if ($validator->fails()) {
            
            return      redirect('register2')   ->withErrors($validator)    ->withInput();
        }
        else{
            
            $data       =   $request->all();
            
            $existUser  =   User::where('email' , $data['email'])->first();
            
            if(! $existUser) {
                
                try {
                    
                    DB::beginTransaction();
                    
                    $newUser = User::create([
                        
                        'name'          => $data['name'],
                        'email'         => $data['email'],
                        'password'      => md5($data['password']),
                    ]);
                    
                    Session::put('user'       ,   $newUser);
                    
                    DB::commit();
                    
                    return      redirect()->route('home2');
                    
                }
                catch (\Exception $exception) {
                    
                    DB::rollBack();
                    
                    \Log::error('Loi:' . $exception->getMessage() . $exception->getLine());
                }
            }   
            else{
                session()->flash('message' , 'This email already exits');
                
                return      redirect()->back();
            }
        }
        
        
        return      redirect()->route('home2');
    }

    
    public function login2()
    {
//       dd(session('link'));
//        dd(url()->previous() );
//        dd(url()->current() );
//        dd(route('logout2'));
//        dd(url());
//      dd(url('/login'));
        
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
        
//        if(!session('comeback'))    session::put('comeback' , true);
        
//        dd(session('comeback'));
        
        return      view('ducauth.login');
    }
    
    
    public function loginning2(Request $request)
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
            
            Session::put('layout'   , '2');
            Session::put('link'     , $locale);
            Session::put('comeback' , $comeback);
            
//             dd(session('comeback'));
//             dd(session('link'));
//            dd(session('link') && session('comeback'));
            if(session('link') && session('comeback'))         return      redirect(session('link'));
            
            else                        return      redirect()->route('home2');
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
    
    public function logout2(Request $request)
    {                   
        Session::flush();
        
        setcookie('usercookie', null, time() - 3600, '/');
        
        session()->flash('message' , 'logout success');
        
        Session::put('comeback' , false);
        
 //       dd(isset($_COOKIE['usercookie']));
 //       dd($_COOKIE);
 //       dd(session()->all());
        
        return      redirect()->route('login2');      
    }
    
    
}
