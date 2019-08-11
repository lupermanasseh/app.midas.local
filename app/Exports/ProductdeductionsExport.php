<?php

namespace App\Exports;

use App\Psubscription;
use App\User;
use App\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
//use Maatwebsite\Excel\Concerns\FromCollection;

class ProductdeductionsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Psubscription::all();
    // }

    public function view():View
    {
        $allProductSub = Psubscription::allProductSubscriptions();

        return view('ProductDeduction.downloadTable',compact('allProductSub'));
    }   
}
