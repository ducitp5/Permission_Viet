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
    
    
    public function store(Request $request)
    {
        dd($request->all());
        
        try {
            
            DB::beginTransaction();
            
            // Insert data to role table
            
            $roleCreate     = $this->role->create([
                
                'name'          => $request->name,
            ]);
            // Insert data to role_permission
            
            $roleCreate     ->permissions()     ->attach(   $request->permission    );
            
            DB::commit();
            
            return      redirect()->route('role2.index');
        }
        catch (\Exception $exception) {
            
            DB::rollBack();
            
            \Log::error('Loi:' . $exception->getMessage() . $exception->getLine());
        }
    }
}