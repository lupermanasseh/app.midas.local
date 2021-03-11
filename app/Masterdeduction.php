<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Lsubscription;
use App\Ldeduction;
use App\User;

class Masterdeduction extends Model
{
    //
    protected $fillable = [
        'name',
        'ippis_no',
        'cumulative_amount',
        'entry_date',
        'cumulative_enddate',
        'description',
        'master_reference',
        'created_by',
    ];

    protected $dates = ['created_at', 'updated_at','entry_date','cumulative_enddate'];

    //Each saving belongs to a user
    public function user(){
        return $this->belongsTo(User::class);
    }
    //A loan subscription may have many over deductions
    public function overdeductions(){
      return $this->hasMany(Loanoverdeduction::class);
  }

  //Method to update Master Deduction records
  public function updateMasterDeduction($masterDeductionObj){

    $records = Ldeduction::where('entry_month', $masterDeductionObj->entry_date)
                            ->where('deduct_reference',$masterDeductionObj->master_reference)
                            ->get();
            if($records){
                //change to inactive
                $masterDeductionObj->status = 'Inactive';
                $masterDeductionObj->save();
            }else{
                //change to active
                $masterDeductionObj->status = 'Active';
                $masterDeductionObj->save();
            }
}
}
