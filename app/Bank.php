<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{

    protected $fillable = [
        'bank_name',
        'acct_number',
        'user_id',
    ];
    //Defining relationship with user bank details
    public function user(){
        return $this->belongsTo(User::class);
    }
}
