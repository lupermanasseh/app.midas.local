<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nok extends Model
{

    //
    protected $fillable = [
        'email',
        'title',
        'first_name',
        'last_name',
        'other_name',
        'gender',
        'phone',
        'relationship',
        'user_id',
    ];

    //Defining a relationship with the User
    public function user(){
        return $this->belongsTo(User::class);
    }
}
