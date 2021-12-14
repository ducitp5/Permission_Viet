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
    
    public function create()
    {
        $roles          =    $this->role->all();
        
        return          view('user.add'     ,   compact('roles'));
    }
    
    public function edit($id)
    {
        $roles              =    $this->role->all();
        
        $user               =    $this->user->findOrfail($id);
        
        $listRoleOfUser     =    DB::table('role_user')     ->where('user_id', $id)
                                                            ->pluck('role_id');
        
 //              dd($listRoleOfUser);
        
        return              view(   'user.edit',
            
            compact('roles'   ,  'user'   ,  'listRoleOfUser'));
    }
    
    public function update(Request $request, $id)
    {
        try {
            
            DB::beginTransaction();
            
            // update user tabale
            
            $this->user     ->where('id', $id)   ->update([
                
                'name'      => $request->name,
                'email'     => $request->email
            ]);
            
            // Update to role_user table
            
            DB::table('role_user')      ->where('user_id' , $id)     ->delete();
            
            $userCreate     =    $this->user    ->find($id);
            
            foreach( $request->roles    as $role_id ){
                
                $userCreate     ->roles()   ->attach( Role::find($role_id) );
            }
            
            DB::commit();
            
            return      redirect()->route('user2.index');
        }
        catch (\Exception $exception) {
            
            DB::rollBack();
        }
    }
}