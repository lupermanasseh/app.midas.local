<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'first_name',
        'last_name',
        'other_name',
        'sex',
        'phone',
        'email',
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
     //Define relationship with roles
     public function roles(){
        return $this->belongsToMany(Role::class,'role_admins');
    }


    //has access method used in authserviceprovider
    public function hasAccess(array $permissions)
    {
        foreach($this->roles as $roles){
            if($role->hasAccess($permissions)){
                return true;
            }
        }
        return false;
    }

    public function inRole($name){
        return $this->roles()->where('name',$name)
        ->count()==1;
    }

    public function checkRole(){
        return $this->roles()->pluck('name')->count()>=1;
    }
}
