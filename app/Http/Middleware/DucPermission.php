<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use DB;
class DucPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {
        $user               =    session('user');   
        
        $listRoleOfUser     =    DB::table('users')
       
           ->join('role_user'   , 'users.id'            , '='   , 'role_user.user_id')
       
           ->join('roles'       , 'role_user.role_id'   , '='   , 'roles.id')
           
           ->where('users.id'   , $user->id)
           
 //          ->select('roles.*')
           
  //         ->get() 
           
            ->pluck('id')   
           
            ->toArray()
        ;
        
        
        dd($listRoleOfUser);

//         dd(User  ::find(auth()->id())   ->roles()       ->select('roles.id')
//                                         ->pluck('id')   ->toArray());

//         $listRoleOfUser     = User  ::find( session('user')->id )

//                                     ->roles()       ->get()

//                                     ->pluck('id')   ->toArray();


        $listPermissionOfUser     = DB::table('roles')

            ->join('role_permission'  , 'roles.id'       , '='   , 'role_permission.role_id')

            ->join('permissions'      , 'permissions.id' , '='   , 'role_permission.permission_id')

            ->whereIn('roles.id'      , $listRoleOfUser)

            ->select('permissions.*')

           ->get()     

           ->pluck('id')      
            ->unique()
        ;

        dd($listPermissionOfUser);

        $checkPermission    =    Permission     ::where('name'  ,  $permission)

//                                                ->get('id')                      //  return colollection
                                                ->value('id')                      //  return value 
        ;
       


        if ( $listPermissionOfUser->contains($checkPermission) ) {

            return $next($request);
        }

        return abort(401);

    }
}
