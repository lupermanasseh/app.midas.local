<?php

namespace App\Exports;

use App\Savingreview;
use Maatwebsite\Excel\Concerns\FromCollection;

class MonthlycontributionExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Savingreview::all();
    }
}
