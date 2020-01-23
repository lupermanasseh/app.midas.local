<?php

namespace App\Exports;

//use App\Saving;
use App\Savingreview;
use App\User;
use App\Targetsr;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
//use Maatwebsite\Excel\Concerns\FromCollection;

class ippisSavingsDeductionsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Saving::all();
    // }

    public function view():View
    {
        

        $savings = Savingreview::where('status','Active')
                                ->get();

        return view('MonthlySaving.ippisSavingDownloadTable',compact('savings'));
    }
}
