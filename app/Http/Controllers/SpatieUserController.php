<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User3;
use Illuminate\Http\Request;
use Hash;
use DB;

class SpatieUserController extends Controller
{
//     private $user;
//     private $role;

    public function __construct(User3 $user, Role $role, Permission $permi )
    {
        $this->user         =   $user;
        $this->role         =   $role;
        $this->permission   =   $permi;
    }


    static function get_this_class_methods($class){
        $array1 = get_class_methods($class);
        if($parent_class = get_parent_class($class)){
            $array2 = get_class_methods($parent_class);
            $array3 = array_diff($array1, $array2);
        }else{
            $array3 = $array1;
        }
        return($array3);
    }

    public function index()
    {
        $listUser       =    $this->user->all();

        return          view('user3.index'   ,   compact('listUser'));
    }


    public function create()
    {
        $roles          =    $this->role->all();

        return          view('user3.add'     ,   compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Insert data to user table

            $userCreate     = $this->user->create([

                'name'          => $request->name,
                'email'         => $request->email,
                'password'      => md5($request->password)
            ]);

            // Insert data to role_user

            //            $userCreate->roles()->attach($request->roles);

            $roles      =    $request->roles;

            $userCreate->syncRoles($roles);

            DB::commit();

            return redirect()->route('user3.index');
        }
        catch (\Exception $exception) {

            DB::rollBack();
        }
    }


    public function edit($id)
    {
        $roles              =    $this->role->all();

        $user               =    $this->user->findOrfail($id);

        $listRoleOfUser     =    $user->roles()->get();

        $permissions        =    $this->permission->all();

        $PermissionOfUser   =    $user->getPermissionsViaRoles();

        return              view(   'user3.edit',

                                    compact('roles'   ,  'user'   ,  'listRoleOfUser'   ,

                                            'permissions',      'PermissionOfUser'));
    }


    public function update(Request $request, $id)
    {
//        dd($request->directPermis);

        try {

            DB::beginTransaction();

            $this->user     ->where('id', $id)   ->update([

                'name'      => $request->name,
                'email'     => $request->email
            ]);

            $user     =    User3::find($id);

            try{

                $user->syncRoles($request->roles) ;

                $user->syncPermissions($request->directPermis);
            }
            catch (\Exception $exception) {

                dd($exception);
            }

            DB::commit();

            return      redirect('/users3/edit/'.$id);
        }
        catch (\Exception $exception) {

            \Log::error('Loi ---'  .'--:' . $exception->getMessage() . $exception->getLine());

            DB::rollBack();
        }
    }


    public function delete($id)
    {
            $user   =    $this->user->find($id)->delete();

            // user Spatie , auto detach roles attached

            return      redirect('users3');

    }
}
