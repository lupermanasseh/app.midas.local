<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Database\Eloquent\Model;

// class Admin extends Model
// {
//     //
// }

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'lastname','firstname','othername','sex','phone','add', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}