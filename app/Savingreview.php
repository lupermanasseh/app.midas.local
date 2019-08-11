<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Savingreview extends Model
{
    //
    //Each saving review belongs to a user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //find active Target saving amount
    public function tsActiveAmount($user_id,$ts){
        //
        $userData = $ts->where('user_id',$user_id);

        foreach($userData as $data){
            return $data->monthly_saving;
        }
       
    }

    //sum saving deduction for ippis
    public function ippisSavingSum($saving,$ts){
       //
       return $saving + $ts;
   }
}
