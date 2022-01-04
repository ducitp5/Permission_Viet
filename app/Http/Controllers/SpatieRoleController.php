<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
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
    
    
    public function store(Request $request)
    {        
            $roleCreate     = $this->role->create([
                
                'name'          => $request->name,
            ]);
            
            $roleCreate     ->permissions()     ->attach(   $request->permission    );            
            
            return      redirect()->route('role3.index');     
    }
    
    
    public function edit($id)
    {
        $permissions                = $this     ->permission    ->all();
        
        $role                       = $this     ->role          ->findOrfail($id);
        
        $getAllPermissionOfRole     = DB::table('role_has_permissions3')
        
                                        ->where('role_id', $id)
                                        
                                        ->pluck('permission_id');
        
        return      view('role.edit'  ,  compact('permissions' , 'role' , 'getAllPermissionOfRole'));
    }
}