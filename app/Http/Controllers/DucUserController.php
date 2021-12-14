<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use DB;

class DucUserController extends Controller
{
    private $user;
    private $role;

    public function __construct(User $user, Role $role)
    {
        $this->user     = $user;
        $this->role     = $role;

    }

    public function index()
    {
        $listUser       =    $this->user->all();
        
        return          view('user.index'   ,   compact('listUser'));
    }
}