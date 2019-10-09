<?php

namespace App\Exports;

use App\Saving;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MasterSavingExport implements FromView
{
    public function __construct($to){
        //$this->pay_type = $pay_type;
        $this->to = $to;
        //$this->end_date = $end_date;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Saving::all();
    // }

    public function view():View
    {
        $saving = new Saving;
        $to = $this->to;
        $savingsCollection = $saving->masterSavingsAsAt($this->to);
        $contributors = Saving::where('status','Active')->get();
        $uniqueContributors = $contributors->unique('user_id');
                                 
        return view('Contributors.masterSavingDownload',compact('savingsCollection','to','saving','uniqueContributors'));
    } 
}
