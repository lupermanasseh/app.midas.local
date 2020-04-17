<?php

namespace App\Imports;

use App\Ldeduction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class legacyLoanDeductionImport implements ToModel,WithHeadingRow
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
        return new Ldeduction([
            //
            'product_id' => $row['product_id'],
            'user_id' => $row['reg_no'],
            'lsubscription_id' => $row['sub_id'],
            'amount_deducted' => $row['amount'],
            'entry_month' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['entry_date']),
            'notes' => $row['description'],
            'deduct_reference' => $this->string,
        ]);
    }
}
