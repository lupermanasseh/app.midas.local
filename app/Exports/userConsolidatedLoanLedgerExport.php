<?php

namespace App\Exports;

use App\Userconsolidatedloan;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class userConsolidatedLoanLedgerExport implements FromView
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

    $consolidatedLoansObj = new Userconsolidatedloan;


         $from = $this->from;
         $to = $this->to;


    $collection = $consolidatedLoansObj->consolidatedLoanDeductionByDate($from,$to);

    $uniqueDebtors = $collection->unique('user_id');
    //return view('LoanDeduction.consolidatedLoanBalancesResult',compact('title','collection','to','from','uniqueDebtors'));
    return view('LoanDeduction.consolidatedLoanBalanceDownload',compact('collection','to','from','uniqueDebtors'));
  }
}
