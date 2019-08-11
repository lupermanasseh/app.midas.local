<?php

namespace App\Exports;

use App\Savingreview;
use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MonthlycontributionExportView implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Savingreview::all();
    // }
    public function view():View
    {
        $savings = Savingreview::where('status','Active')->with(['user' => function ($query) {
            $query->orderBy('id', 'desc');
        }])->get();

        return view('MonthlySaving.savingTableDownload',compact('savings'));
    }
}
