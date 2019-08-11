<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    //Defining relationship with user bank details
    public function user(){
        return $this->belongsTo(User::class);
    }
}
