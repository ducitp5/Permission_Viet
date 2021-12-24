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
        dd($this->role::find(8) );
        
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
 //       dd($request->all());
        
        try {
            
            DB::beginTransaction();
            
            // Insert data to role table
            
            $roleCreate     = $this->role->create([
                
                'name'          => $request->name,
            ]);
            // Insert data to role_permission
            
//            dd($roleCreate);
            
//            $creatpermis    =  $roleCreate     ->permissions()     ->attach(   $request->permission    );
            
//            dd($roleCreate     ->permissions);
            
            foreach ($request->permission as $permi){
            
                $roleCreate->givePermissionTo($permi);
            }
            
            DB::commit();
            
            return      redirect()->route('role3.index');
        }
        catch (\Exception $exception) {
            
            DB::rollBack();
            
            \Log::error('Loi:' . $exception->getMessage() . $exception->getLine());
        }
    }
}