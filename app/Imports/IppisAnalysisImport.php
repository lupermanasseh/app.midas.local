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
    public function __construct($rand){
        $this->string = $rand;
    }

    public function model(array $row)
    {
        return new Masterdeduction([
            //
            //'ippis_no' => $row['ippis_number'],
            'ippis_no' => $row['reg_no'],
            'name' => $row['name'],
            'entry_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['entry_date']),
            'description' => $row['description'],
            'cumulative_amount' => $row['amount'],
            'master_reference' => $this->string,
            'created_by' => auth()->user()->first_name,
        ]);
    }
}
