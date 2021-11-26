<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use DB;
class CheckPermissionAcl
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
// Lay tat ca cac quyen khi user login vao he thong
        // 1. Lay tat ca cac role cua user login vao he thong
//        $listRoleOfUser = DB::table('users')
//            ->join('role_user', 'users.id', '=', 'role_user.user_id')
//            ->join('roles', 'role_user.role_id', '=', 'roles.id')
//            ->where('users.id', auth()->id())
//            ->select('roles.*')
//            ->get()->pluck('id')->toArray();

//        dd(User  ::find(auth()->id()) ->roles()->get() ->pluck('id')->toArray());

        $listRoleOfUser     = User  ::find(auth()->id())

                                    ->roles()       ->select('roles.id')
                                    ->pluck('id')   ->toArray();


//         2. lay tat ca cac quyen khi user login vao he thong

        $listRoleOfUser     = DB::table('roles')

            ->join('role_permission', 'roles.id', '=', 'role_permission.role_id')
            ->join('permissions', 'role_permission.permission_id', '=', 'permissions.id')
            ->whereIn('roles.id', $listRoleOfUser)
            ->select('permissions.*')
            ->get()->pluck('id')->unique();

        // Lay tat ca cac quyen khi user login vao he thong
        // lay ra ma man hinh tuong ung de check phan quyen

        $checkPermission = Permission::where('name', $permission)->value('id');

//        dd($checkPermission);
        // kiem tra user dc phep vao man hinh nay khong?

        if ( $listRoleOfUser->contains($checkPermission) ) {
            return $next($request);
        }

        return abort(401);

    }
}
