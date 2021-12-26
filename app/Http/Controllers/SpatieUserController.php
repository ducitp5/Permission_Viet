<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\Models\User3;
use Illuminate\Http\Request;
use Hash;
use DB;

class SpatieUserController extends Controller
{
//     private $user;
//     private $role;

   

    public function __construct(User3 $user ,Role $role)
    {
        $this->user     =   $user;
        $this->role     =   $role;
    }


    public function index()
    {
        $listUser       =    $this->user->all();

        return          view('user.index'   ,   compact('listUser'));
    }


    public function edit($id)
    {
        $roles              =    $this->role->all();   

        $user               =    $this->user->findOrfail($id);

//        dd($user->roles()->get());                     // Illuminate\Database\Eloquent\Relations\MorphToMany
//        dd(User::find($id)->with('roles')->get());     // dont use bcs belongtomany (not has many)          // Illuminate\Database\Eloquent\Builder
        
//         $listRoleOfUser     =    DB::table('role_user')     ->where('user_id', $id)
//                                                             ->pluck('role_id');

        $listRoleOfUser     =    $user->roles()->get();
        
//        dd($listRoleOfUser);
        
//        $userroles          =    $user::with('roles')->get();
        
//        dd($userroles);
        
        return              view(   'user.edit',

                                    compact('roles'   ,  'user'   ,  'listRoleOfUser'));
    }
}
