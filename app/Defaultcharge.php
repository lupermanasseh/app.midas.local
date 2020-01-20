<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Defaultcharge extends Model
{
    protected $dates = ['created_at', 'updated_at','entry_month'];
    
    //relationship with user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //relationship with loan subscription
    public function subscription(){
        return $this->belongsTo(Lsubscription::class);
    }
 
    //relationship with product
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
