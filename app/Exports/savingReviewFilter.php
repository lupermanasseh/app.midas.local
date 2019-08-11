<?php

namespace App\Exports;

use App\Savingreview;
use App\Lsubscription;
use App\User;
use App\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
//use Maatwebsite\Excel\Concerns\FromCollection;

class savingReviewFilter implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Savingreview::all();
    // }

    public function __construct($from,$to){
        //$this->pay_type = $pay_type; //removed $pay_type from constructor
        $this->from = $from;
        $this->to = $to;
    }

    public function view():View
    {
        $savingsFilter = Savingreview::where('created_at','>=',$this->from)
                                        ->where('created_at','<=',$this->to)
                                        ->where('status','Active')
                                        ->oldest()->with(['user'])
                                        ->get();

      

        return view('MonthlySaving.filterDownload',compact('savingsFilter'));
    } 
}
