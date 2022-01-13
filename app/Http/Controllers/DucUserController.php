<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use DB;
use App\Models\Permission;

class DucUserController extends Controller
{
    private $user;
    private $role;
    private $permission;

    public function __construct(User $user, Role $role, Permission $permi)
    {
        $this->user         =   $user;
        $this->role         =   $role;
        $this->permission   =   $permi;
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

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $userCreate     = $this->user->create([

                'name'          => $request->name,
                'email'         => $request->email,
                'password'      => Hash::make($request->password)
            ]);

            //            $userCreate->roles()->attach($request->roles);

            $roles      =    $request->roles;

            foreach ($roles as $roleId) {

                \DB::table('role_user')->insert([

                    'user_id'    => $userCreate->id,
                    'role_id'    => $roleId
                ]);
            }

            DB::commit();

            return redirect()->route('user2.index');
        }
        catch (\Exception $exception) {

            DB::rollBack();
        }
    }

    public function edit($id)
    {
        $roles              =    $this->role->all();

        $user               =    $this->user->findOrfail($id);

        $listRoleOfUser     =    DB::table('role_user')     ->where('user_id', $id)
                                                            ->pluck('role_id');
        $permissions        =    $this->permission->all();
        $PermissionOfUser   =    $user->permissionByModel();

        return              view(   'user.edit',

                                    compact('roles'   ,  'user'   ,  'listRoleOfUser'   ,   'permissions'  ,   'PermissionOfUser'));
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
//dd($request);

            if($request->roles){

                foreach( $request->roles    as $role_id ){

                    $userCreate     ->roles()   ->attach( Role::find($role_id) );
                }
            }


            // Update to permission_user table

            $userCreate->directPermissions()->sync( $request->directPermis );

            DB::commit();

            return         redirect()->back()->with('message' , 'da update user thanh cong');
        }
        catch (\Exception $exception) {

            DB::rollBack();
            dd($exception);
        }
    }


}
