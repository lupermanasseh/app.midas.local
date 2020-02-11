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

      //Function to get sum of default for loans to add to  total loan deductions
      public static function defaultChargesTotal($user_id){
        return static::where('user_id',$user_id)
                     ->where('status','Active')
                     ->sum('default_charge');
    }

      //Function to get sum of deficit for loans to add to  total loan deductions
      public static function deficitTotal($user_id){
        return static::where('user_id',$user_id)
                     ->where('status','Active')
                     ->sum('deficit');
    }

    //Function to get sum of deficit by subscription

    public static function defaultBySubscription($_id){
        return static::where('status','Active')
                        ->where('lubscription_id','=',$_id)
                        ->sum('deficit');
    }
}
