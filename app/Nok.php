<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nok extends Model
{
    //Defining a relationship with the User
    public function user(){
        return $this->belongsTo(User::class);
    }
}
