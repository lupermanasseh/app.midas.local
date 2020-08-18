<?php

namespace App\Exports;

use App\Ldeduction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class loanBalanceExport implements FromView
{

  public function __construct($from,$to){

      $this->from = $from;
      $this->to = $to;

  }

    /**
    * @return \Illuminate\Support\Collection
    */
      public function view():View
    {

      $loanDeductionObj = new Ldeduction;
      $from = $this->from;
      $to = $this->to;
      $loanDeductionCollection = $loanDeductionObj->findLoanDeductionByDate($this->from,$this->to);

      $uniqueDebtors = $loanDeductionCollection->unique('user_id');
      return view('LoanDeduction.loanBalanceDownload',compact('loanDeductionCollection','to','from','$loanDeductionObj','uniqueDebtors'));
    }
}
