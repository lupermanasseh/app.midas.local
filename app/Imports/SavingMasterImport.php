<?php

namespace App\Imports;

use App\Savingmaster;
use Maatwebsite\Excel\Concerns\ToModel;

class SavingMasterImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Savingmaster([
            //
            'ippis_no' => $row['ippis_number'],
            'name' => $row['name'],
            'entry_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date']),
            //$row['date'],
            'saving_cumulative' => $row['amount'],
            'ts_cumulative' => $row['amount'],
            'total' => $row['amount'],
            //'notes' => $row['description'],
            'created_by' => auth()->id(),
        ]);
    }
}
