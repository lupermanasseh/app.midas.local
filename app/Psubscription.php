<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Savingreview;
use App\Psubscription;
use App\Lsubscription;
use App\Productdeduction;
use Carbon\Carbon;
class Psubscription extends Model
{
    
    //relationship with user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //relationship with products
    //Done ; Each product subscription belongs to a product
    public function product(){
        return $this->belongsTo(Product::class);
    }

    protected $dates = ['created_at','updated_at','start_date','end_date'];


    //all product subscriptions
    public static function allProductSubscriptions(){

         return  static::where('status', 'Active')->with(['user','product'])->get();
        
        // return  static::findAll()
        // ->with(['user','product'])
        // ->get();
    }

    // Product subscriptionn item details
    public static function itemDetails($id){
        return static::find($id);
    } 

     //User active product subscriptions
     public static function userProducts($id){
        //
        return static::where('user_id', '=', $id)
                ->where(function ($query) {
                 $query->where('status', '=', 'Active');
                })->with(['product'])
                ->get();
        
        // return static::where('user_id', '=', $id)
        //         ->with(['product'])
        //         ->orderBy('start_date','desc')
        //         ->get();
        
    }

    //User Pending product subscriptions
     public static function pendingProducts($id){

        return static::where('user_id', '=', $id)
        ->where(function ($query) {
            $query->where('status', '=', 'Pending');
        })
        ->with(['product','user'])
        ->orderBy('start_date','desc')
        ->get();
        
    }

     //All pending subscriptions
     public static function pendingSubs(){
        return static::where('status','Pending')
        ->oldest()
        ->with(['product','user'])
        ->paginate(100);
        }

        //All active subscriptions
        public static function activeSubs(){
            return static::where('status','Active')
            ->orderBy('user_id','asc')
            ->orderBy('start_date','asc')
            ->with(['product','user'])
            ->paginate(100);
            }
        
    //Find Total deduction for a given subscription

    public  function totalSubDeductions($subscription_id)
    {
        return Productdeduction::where('psubscription_id',$subscription_id)
        ->sum('monthly_deduction');
    }

   //Get product subscription guarantor 
     public function userInstance($id){
        $user= $this::find($id);
        return $user->first_name;
    }

    //Total product cost
    public static function TotalProductCost($cost,$units){
        return $cost * $units;
    }

}
