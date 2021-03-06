<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;          // Spatie package

use Illuminate\Database\Eloquent\Model;

class User3 extends model
{    
    use HasRoles;                               // Spatie package

    protected   $guard_name     =   'web';          //  LOG.error  The given role or permission should use guard `` instead of `web`

    protected   $table          =   'users';

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

//  LOG.error  The given role or permission should use guard `` instead of `web`

//     public function guardName(){

//         return "web";
//     }
}
