<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cache;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','name',  'password', 'username', 'role_id', 'contact_no', 'age', 'address', 'disabled', 'birthday', 'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
 
    public function isAdmin()
    {
        return auth()->check() && auth()->user()->role->name == 'Chairman';
    }
    public function isPfcAdmin()
    {
        return auth()->check() && auth()->user()->role->name == 'PFC Admin';
    }
    public function isParish()
    {
        return auth()->check() && auth()->user()->role->name == 'Parish Priest';
    }

    public function isCommissionHead()
    {
        return auth()->check() && auth()->user()->role->name == 'Commission Head';
    } 

    public function isPpc()
    {
        return auth()->check() && auth()->user()->role->name == 'PPC';
    }

    public function isPfc()
    {
        return auth()->check() && auth()->user()->role->name == 'PFC';
    }

    public function hasRole($role)
    {
        return in_array($this->role->name, $role);
    }

}
