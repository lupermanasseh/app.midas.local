<?php

namespace App\Imports;

use App\Masterdeduction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IppisAnalysisImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Masterdeduction([
            //
            'ippis_no' => $row['ippis_number'],
            'name' => $row['name'],
            'entry_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date']),
            //$row['date'],
            'cumulative_amount' => $row['amount'],
            //'notes' => $row['description'],
            'created_by' => auth()->id(),
        ]);
    }
}
