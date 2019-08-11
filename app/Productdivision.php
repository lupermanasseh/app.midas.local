<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productdivision extends Model
{
    //Has many through relationship
    /**
     * Get all subscriptions for a product category
     */
    //
    public function subscriptions(){
        return $this->hasManyThrough('App\Lsubscription', 'App\Product');
    }
    //
    public function products(){
        return $this->hasMany(Product::class);
    }

    //
    //List all products category
    public static function  productCatList(){
        return static::orderBy('name')
        ->pluck('name','id');
    }
}
