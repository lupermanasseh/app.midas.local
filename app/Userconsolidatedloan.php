<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userconsolidatedloan extends Model
{

  protected $fillable = [
     'user_id',
     'lsubscription_id',
     'amount_deducted',
     'entry_month',
     'notes',
     'uploaded_by',
 ];

protected $dates = ['created_at', 'updated_at','date_entry'];

    //relationship with user
      public function user(){
      return $this->belongsTo(User::class);
      }

        //Each record belongs to a loan subscription
        public function loansubscription(){
            return $this->belongsTo(Lsubscription::class,'lsubscription_id');
        }
}
