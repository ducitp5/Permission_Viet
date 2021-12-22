<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use DB;

class SpatieUserController extends Controller
{
    private $user;
    private $role;

    public function __construct(User $user ,Role $role)
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

        $listRoleOfUser     =    DB::table('role_user')     ->where('user_id', $id)
                                                            ->pluck('role_id');

        return              view(   'user.edit',

                                    compact('roles'   ,  'user'   ,  'listRoleOfUser'));
    }
}
