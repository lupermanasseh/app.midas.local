<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class staff extends Authenticatable
{
    //
    use Notifiable;

    protected $fillable = [
         'surname',
         'firstname', 
         'lastname',
         'email',
         'password',
    ];

    protected $hidden = [
        'password',
    ];
}
