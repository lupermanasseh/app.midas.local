<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Savingreview;
use App\Psubscription;
use App\Lsubscription;
class Productdeduction extends Model
{
    //
    protected $fillable = [
        'user_id', 
        'psubscription_id',
        'product_id',
        'monthly_deduction', 
        'entry_date',
        'uploaded_by',
    ];

    protected $dates = ['created_at', 'updated_at','entry_date'];

    //Each product deduction belongs to a user
    public function user(){
        return $this->belongsTo(User::class);
    }


    //Each deduction belongs to a product subscription
    // public function productsubscription(){
    //     return $this->belongsTo(Psubscription::class);
    // }

    //Each product deduction belongs to a product
    public function product(){
        return $this->belongsTo(Product::class);
    }

    //Product deduction details
    public static function deductionDetails($id){
        return static::find($id);
    } 

   
}
