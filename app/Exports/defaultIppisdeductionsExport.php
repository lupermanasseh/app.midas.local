<?php

namespace App\Exports;
use App\Lsubscription;
use App\User;
use App\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
//se Maatwebsite\Excel\Concerns\FromQuery;
//use Maatwebsite\Excel\Concerns\Exportable;

//use App\Lsubscription;
//use Maatwebsite\Excel\Concerns\FromCollection;

class defaultIppisdeductionsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Lsubscription::all();
    // }

    public function view():View
    {
        $loanSub = Lsubscription::distinctUserLoanSub();
        $activeLoans = Lsubscription::where('loan_status','Active')
                                     ->get();

        return view('LoanDeduction.ippisdownload',compact('loanSub','activeLoans'));
    } 
}
