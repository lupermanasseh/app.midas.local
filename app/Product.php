<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name',
        'description', 
        // 'lastname',
        // 'email',
        // 'password',
    ];
     //Each product belongs to a product category
     public function productcategory(){
        return $this->belongsTo(Productdivision::class,'productdivision_id');
    }
    //Define relationship with product subscription
    //A product can have more than one product subscriptions
    public function psubscriptions(){
        return $this->hasMany(Psubscription::class);
    }
    //A product can have more than one subscription
    public function lsubscriptions(){
        return $this->hasMany(Lsubscription::class);
    }

    //A product can have more than one product deductions
    public function pdeductions(){
        return $this->hasMany(Productdeduction::class);
    }

      //A product can have more than one loan deductions
      public function ldeductions(){
        return $this->hasMany(Ldeduction::class);
    }
    
     //A product can have more than one loan default charge
     public function defaultcharge(){
        return $this->hasMany(Deafultcharge::class);
    }

    //List all products
    public static function  productList(){
        return static::where('status','Active')
        ->orderBy('name')
        ->pluck('name','id');
    }

    public static function productItems($id){
        return static::where('productdivision_id',$id)
        ->orderBy('name')
        ->get();
    }
    //Product Subscription Count
    public  function productSubCount($id)
    {
        //Number of active loans
        $subCount = Psubscription::where('product_id', '=', $id)
        ->where(function ($query) {
            $query->where('status', '=', 'Active');
        })->get();
        return $subCount->count();
    }
    
    protected $dates = ['created_at', 'updated_at'];
}
