<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function directPermissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user', 'user_id', 'permission_id');
    }

    public function permissionByDB()
    {
        $listRoleOfUser         =    DB::table('role_user')     ->where('user_id', $this->id)
                                                                ->pluck('role_id');

        $listPermissionOfUser   =    DB::table('roles')

            ->join('role_permission'  , 'roles.id'       , '='   , 'role_permission.role_id')

            ->join('permissions'      , 'permissions.id' , '='   , 'role_permission.permission_id')

            ->whereIn('roles.id'      , $listRoleOfUser)

            ->select('permissions.*')                               // Builder

            ->get()                                                 // Collection

            ->unique()
        ;

        return     $listPermissionOfUser;
    }

    public function permissionByModel()
    {
        $listPermissionOfUser   =    collect();

        foreach ( $this->roles()->get() as $role){

            $listPermissOfRole    =   $role->permissions()->get();

            foreach($listPermissOfRole as $permi){

                $listPermissionOfUser->add($permi);
            }

        }
        $listPermissionOfUser    =   $listPermissionOfUser->unique('id');

        return     $listPermissionOfUser;
    }

    public function getDirectPermissions(){

        return     $this->directPermissions()->get();
    }

    public function getAllPermissions(){

        $allPermissionOfUser   =    collect();

        foreach ($this->roles()->get() as $role){

            $listPermissOfRole    =   $role->permissions()->get();

            foreach($listPermissOfRole as $permi){

                $allPermissionOfUser->add($permi);
            }
        }

        foreach ( $this->getDirectPermissions() as $directpermi){

            $allPermissionOfUser->add($directpermi);
        }

        return     $allPermissionOfUser->pluck('id')->unique();
    }

}
