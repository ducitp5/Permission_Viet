<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    
    return view('welcome');
});


Auth::routes();

Route::get('/home'  , [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {

    // modulle user

    Route::prefix('users')->group(function () {

        // list user
        Route::get('/'          , [
            'as'            => 'user.index',
            'uses'          => 'UserController@index',
            'middleware'    => 'checkacl:user-list'
        ]);

        // create user

        Route::get('/create'    , [
            'as'            => 'user.add',
            'uses'          => 'UserController@create',
            'middleware'    => 'checkacl:user-add'
        ]);

        Route::post('/create'       ,    'UserController@store')    ->name('user.store');

        // edit user
        
        Route::get('/edit/{id}'     ,    'UserController@edit')     ->name('user.edit');
        
        Route::post('/edit/{id}'    ,    'UserController@update')   ->name('user.edit');
        
        // delete user
        
        Route::get('/delete/{id}'   ,    'UserController@delete')   ->name('user.delete');

    });


    // module role

    Route::prefix('roles')->group(function () {

        // list role
        Route::get('/',
            [
                'as'            => 'role.index',
                'uses'          => 'RoleController@index',
                'middleware'    => 'checkacl:role-list'
            ]);

        // create role

        Route::get('/create'        , 'RoleController@create')  ->name('role.add');
        Route::post('/create'       , 'RoleController@store')   ->name('role.store');

        // edit role

        Route::get('/edit/{id}'     , 'RoleController@edit')    ->name('role.edit');
        Route::post('/edit/{id}'    , 'RoleController@update')  ->name('role.edit');

        // delete role

        Route::get('/delete/{id}'   , 'RoleController@delete')  ->name('role.delete');

    });
});


Route::get ('/session'       , 'HomeController@session')         ->name('session');
Route::get ('/auth'          , 'HomeController@auth')            ->name('auth');
Route::get ('/request'       , 'HomeController@request')         ->name('request');

Route::get ('/register2'     , 'DucAuthController@register2')    ->name('register2');
Route::post('/register2'     , 'DucAuthController@registing2')   ->name('register2');

Route::get ('/login2'        , 'DucAuthController@login2')       ->name('login2');
Route::post('/login2'        , 'DucAuthController@loginning2')   ->name('login2');

Route::get ('/logout2'       , 'DucAuthController@logout2')      ->name('logout2');


Route::middleware(['ducauth'])->group(function () {
    
    Route::get ('/home2'            , 'DucAuthController@index2')      ->name('home2');
    
    
    Route::prefix('users2')->group(function () {
        
        Route::get ('/index'        , 'DucUserController@index')      
        
            ->name('user2.index')   ->middleware('ducpermis:user-list');
        
        Route::get('/create'        , 'DucUserController@create')
            
            ->name('user2.add')     ->middleware('ducpermis:user-add');
            
        Route::post('/create'        , 'DucUserController@store')
            
            ->name('user2.store')     ->middleware('ducpermis:user-add');
            
        Route::get ('/edit/{id}'    , 'DucUserController@edit')
            
            ->name('user2.edit')    ->middleware('ducpermis:user-edit');
        
        Route::post ('/edit/{id}'    , 'DucUserController@update')
            
            ->name('user2.edit')    ->middleware('ducpermis:user-edit');
            
        Route::get ('/delete/{id}'  , 'DucUserController@delete')
            
            ->name('user2.delete')  ->middleware('ducpermis:user-delete');
                
    });
    
    
    Route::prefix('roles2')->group(function () {
        
        Route::get('/create'        , 'DucRoleController@create')       
        
            ->name('role2.add')     ->middleware('ducpermis:role-add');
        
        Route::post('/create'       , 'DucRoleController@store')    
        
            ->name('role2.store')   ->middleware('ducpermis:role-add');
        
        Route::get ('/index'        , 'DucRoleController@index')        ->name('role2.index');
        
        Route::get ('/edit/{id}'    , 'DucUserController@edit')
        
            ->name('role2.edit')    ->middleware('ducpermis:user-edit');
        
        Route::get ('/delete/{id}'  , 'DucUserController@delete')
            
            ->name('role2.delete')  ->middleware('ducpermis:user-delete');
    });
        
    
});


Route::get ('/login3'        , 'SpatieAuthController@login3')       ->name('login3');
Route::post('/login3'        , 'SpatieAuthController@loginning3')   ->name('login3');

Route::get ('/logout3'       , 'SpatieAuthController@logout3')      ->name('logout3');

Route::middleware(['Spatieauth'])->group(function () {
    
    Route::get ('/home3'            , 'SpatieAuthController@index3')      ->name('home3');
    
    
    Route::prefix('users3')->group(function () {
        
        Route::get ('/'             , 'SpatieUserController@index')     ->name('user3.index');
        
        Route::get('/create'        , 'SpatieUserController@create')    ->name('user3.add');
        
        Route::post('/create'       , 'SpatieUserController@store')     ->name('user3.store');
        
        Route::get ('/edit/{id}'    , 'SpatieUserController@edit')      ->name('user3.edit');
        
        Route::post ('/edit/{id}'   , 'SpatieUserController@update')    ->name('user3.edit');
        
        Route::get ('/delete/{id}'  , 'SpatieUserController@delete')    ->name('user3.delete');
                
    });
        
        
    Route::prefix('roles3')->group(function () {
        
        Route::get ('/index'        , 'SpatieRoleController@index')         ->name('role3.index');
        
        Route::get('/create'        , 'SpatieRoleController@create')        ->name('role3.add');
        
        Route::post('/create'       , 'SpatieRoleController@store')         ->name('role3.store');
        
        Route::get('/edit/{id}'     , 'SpatieRoleController@edit')    ->name('role3.edit');
        Route::post('/edit/{id}'    , 'SpatieRoleController@update')  ->name('role3.edit');
    });
            
            
});