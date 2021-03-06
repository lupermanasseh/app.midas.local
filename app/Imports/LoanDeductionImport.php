<?php

namespace App\Imports;

use App\Ldeduction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LoanDeductionImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Ldeduction([
                //
                'user_id' => $row['user_id'],
                'product_id' => $row['product_id'],
                'lsubscription_id' => $row['subscription_id'],
                'entry_month' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date']),
                //$row['date'],
                'amount_deducted' => $row['amount'],
                'notes' => $row['description'],
                'uploaded_by' => auth()->user()->first_name,
        ]);
    }
}
