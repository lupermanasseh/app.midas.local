<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = [
        'name',
        'description', 
        'permissions',
        
   ];
//Define relationships with Users
public function users(){
    return $this->belongsToMany(User::class,'role_users');

}
//new role relationshi mappings
public function admins(){
    return $this->belongsToMany(User::class,'role_admins');

}

//
public static function allRoles(){
    return static::orderBy('name')->pluck('name','id');
}

//has access for permisions

public function hasAccess(array $permissions)
    {
        foreach($permissions as $permission){
            if($role->hasPermission($permission)){
                return true;
            }
        }
        return false;
    }


    //has permission
    protected function hasPermission(string $permission )
    {
        $permissions = json_decode($this->permissions,true);
        return $permissions[$permission]??false;
    }
}
