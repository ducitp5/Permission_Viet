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

        return          view('user.index'   ,   compact('listUser'));
    }


    public function edit($id)
    {
        $roles              =    $this->role->all();

        $user               =    $this->user->findOrfail($id);

        $listRoleOfUser     =    $user->roles()->get();

        return              view(   'user.edit',

                                    compact('roles'   ,  'user'   ,  'listRoleOfUser'));
    }


    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->user     ->where('id', $id)   ->update([

                'name'      => $request->name,
                'email'     => $request->email
            ]);

 //           dd($request->roles);

            $user     =    User3::find($id);

            var_dump($user);

            try{

                $user->roles()->detach();

            //          methode 1 :     use attach relation belongtomany

//            $user     ->roles()   ->attach( $request->roles);

//          methode 2 :     use SpatieRole

                $user->assignRole($request->roles) ;

            }
            catch (\Exception $exception) {

                \Log::error('Loi SpatieUserController.update:' . $exception->getMessage() . $exception->getLine());
            }

            DB::commit();

//            return      redirect('/users3/edit/'.$id);
        }
        catch (\Exception $exception) {

            \Log::error('Loi ---'  .'--:' . $exception->getMessage() . $exception->getLine());

            DB::rollBack();
        }
    }
}
