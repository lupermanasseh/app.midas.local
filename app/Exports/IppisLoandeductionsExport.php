<?php

namespace App\Exports;

use App\Lsubscription;
use App\User;
use App\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
// use Maatwebsite\Excel\Concerns\FromQuery;
// use Maatwebsite\Excel\Concerns\Exportable;
//use Maatwebsite\Excel\Concerns\FromCollection;

class IppisLoandeductionsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Lsubscription::all();
    // }

    // public function view():View
    // {
    //     $loanSub = Lsubscription::distinctUserLoanSub();

    //     return view('LoanDeduction.ippisdownload',compact('loanSub'));
    // }  
    public function __construct($start_date,$end_date){
        //$this->pay_type = $pay_type;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function view():View
    {
        
        $loanSub = Lsubscription::filterResult($this->start_date,$this->end_date);
        //select active loans based on date range in the new method
        $activeLoans = Lsubscription::where('loan_status','Active')
                                    ->get();
        // $premResult = Lsubscription::whereBetween('created_at',[$this->start_date,$this->end_date])
        // ->with(['loan','user'])->get();
        // $loanSub = $premResult->where('repayment_mode',$this->pay_type)->unique('user_id');

        return view('LoanDeduction.ippisdownload',compact('loanSub','activeLoans'));
    } 
  
}
