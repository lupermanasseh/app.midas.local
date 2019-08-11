<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ldeduction extends Model
{
    
     protected $fillable = [
        'user_id', 
        'product_id',
        'lsubscription_id',
        'amount_deducted', 
        'entry_month',
        'notes',
        'uploaded_by',
    ];

    protected $dates = ['created_at', 'updated_at','entry_month'];

     //Each loan deduction belongs to a user
     public function user(){
        return $this->belongsTo(User::class);
    }

    //Each loan deduction belongs to a loan subscription
    public function loansubscription(){
        return $this->belongsTo(Lsubscription::class);
    }

      //Each loan deduction belongs to a loan Product
      public function loan(){
        return $this->belongsTo(Loan::class);
    }

    //Each loan deduction belongs to a loan Product
    public function product(){
        return $this->belongsTo(Product::class);
    }

    //Loan Deduction history
    //pass in subscription id
    public static function loanHistory($id){
        return static::where('lsubscription_id',$id)
        ->with(['product' => function ($query) {
        $query->orderBy('name', 'desc');
        }])->latest()->get();
    }

}
