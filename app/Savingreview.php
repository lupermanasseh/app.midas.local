<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Targetsr;
use App\TargetSaving;
use Illuminate\Support\Facades\DB;

class Savingreview extends Model
{
    //
    protected $fillable = [
        'user_id', 
        'current_amount',
        'created_by', 
    ];
    //Each saving review belongs to a user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //find active Target saving amount
    public function tsActiveAmount($user_id){
        
        //
        $userData = Targetsr::where('user_id',$user_id)
                        ->where('status','Active')
                        ->get();
        if($userData->isNotEmpty()){
            foreach($userData as $data){
                return $data->monthly_saving;
            }
        }else{
            return 0;
        }   
       
    }

    //sum saving deduction for ippis
    public function ippisSavingSum($saving,$ts){
       //
       return $saving + $ts;
   }
}
