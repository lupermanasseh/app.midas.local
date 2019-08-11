<?php

namespace App\Exports;

use App\Targetsr;
use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
//use Maatwebsite\Excel\Concerns\FromCollection;

class TargetSavingExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Targetsr::all();
    // }

    public function view():View
    {
        $ts = Targetsr::where('status','Active')->with(['user' => function ($query) {
            $query->orderBy('id', 'desc');
        }])->get();

        return view('TargetSaving.tsdownload',compact('ts'));
    }
}
