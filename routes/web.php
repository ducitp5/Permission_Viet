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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/users', 'UserController@index');

Route::middleware(['auth'])->group(function () {

    // modulle user

    Route::prefix('users')->group(function () {

        // list user
        Route::get('/', [
            'as'            => 'user.index',
            'uses'          => 'UserController@index',
//            'middleware' => 'checkacl:user-list'
        ]);

        // create user

        Route::get('/create', [
            'as'            => 'user.add',
            'uses'          => 'UserController@create',
 //           'middleware'    => 'checkacl:user-add'
        ]);

        Route::post('/create', 'UserController@store')->name('user.store');
        // edit user
        Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
        Route::post('/edit/{id}', 'UserController@update')->name('user.edit');
        // delete user
        Route::get('/delete/{id}', 'UserController@delete')->name('user.delete');

    });

});
