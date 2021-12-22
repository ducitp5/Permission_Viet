<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use DB;

class SpatieRoleController extends Controller
{
    private $user;
    private $role;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role         = $role;
        $this->permission   = $permission;
    }
    
    // list all role
    
    public function index()
    {
        $listRole   = $this->role->all();
               
        return      view('role.index', compact('listRole'));        
    }
       
    
    public function create()
    {
        $permissions    = $this->permission->all();
        
        return          view('role.add', compact('permissions'));
    }
}