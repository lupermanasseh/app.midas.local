<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Loanoverdeduction extends Model
{
    //
    protected $fillable = [
       'user_id',
       'masterdeduction_id',
       'status',
       'entry_time',
       'ref',
       'overdeduction_amount',
       'entry_date',
       'created_by',
       'post_by',
   ];

   protected $dates = ['created_at', 'updated_at','entry_date'];

    //Each loan over deduction belongs to a user
    public function user(){
       return $this->belongsTo(User::class);
   }

   //Each loan over deduction belongs to a master ippis loan deduction
   public function masterloandeduction(){
      return $this->belongsTo(Masterdeduction::class);
  }

  public  function saveOverDeduction($masterDeductionObj,$overdeduction){

    $newOverDeduction = new Loanoverdeduction;
    $now = Carbon::now()->toTimeString();
    $newOverDeduction->user_id = $masterDeductionObj->ippis_no;
    $newOverDeduction->masterdeduction_id = $masterDeductionObj->id;
    $newOverDeduction->overdeduction_amount = $overdeduction;
    $newOverDeduction->status = 'Active';
    $newOverDeduction->entry_date = $masterDeductionObj->entry_date;
    $newOverDeduction->ref = $masterDeductionObj->master_reference;
    $newOverDeduction->created_by = auth()->user()->first_name;
    $newOverDeduction->entry_time = $now;
    $newOverDeduction->save();

  }
}
