<?php

namespace App\Imports;

use App\Savingmaster;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SavingMasterImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function __construct($rand){

        $this->string = $rand;

    }
    public function model(array $row)
    {
        return new Savingmaster([
            //
            'ippis_no' => $row['ippis_no'],
            'name' => $row['name'],
            'entry_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date']),
            //$row['date'],
            'saving_cumulative' => $row['contribution'],
            'ref_identification' => $this->string,
            ///'total' => $row['total'],
            'notes' => $row['description'],
            'created_by' => auth()->user()->first_name,
        ]);
    }
}
