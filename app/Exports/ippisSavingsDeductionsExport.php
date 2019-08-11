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
        $ts = Targetsr::where('status','Active')
        ->get();

        $savings = Savingreview::where('status','Active')
                  ->oldest()
                  ->with(['user'])
                  ->get();

        return view('MonthlySaving.ippisSavingDownloadTable',compact('savings','ts'));
    }
}
