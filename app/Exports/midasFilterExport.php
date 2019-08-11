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

class midasFilterExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Lsubscription::all();
    // }

    //use Exportable;
    public function __construct($start_date,$end_date){
        //$this->pay_type = $pay_type;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    
    public function view():View
    {
        $loanSub = Lsubscription::filterResult($this->start_date,$this->end_date);
                                    // $premResult = Lsubscription::
        //                          where('loan_start_date','>=',$this->start_date)
        //                         ->where('loan_start_date','<=',$this->end_date)
        //                         ->with(['loan','user'])
        //                         ->get();

        return view('LoanDeduction.download',compact('loanSub'));
    } 

    // public function query(){
    //     //filter query
    //      $filterResult = Lsubscription::whereBetween('created_at',[$this->start_date,$this->end_date])
    //                     ->with(['loan','user']);
    //     return $filterResult->where('repayment_mode',$this->pay_type);
    // }
}
