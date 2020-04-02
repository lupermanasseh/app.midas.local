<?php

namespace App\Imports;

use App\Lsubscription;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LegacyLoanImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Lsubscription([
            //
               //
               'product_id' => $row['product_id'],
               'user_id' => $row['reg_no'],
               'guarantor_id1' => $row['guarantor_one'],
               'guarantor_id2' => $row['guarantor_two'],
               'amount_approved' => $row['amount'],
               'loan_status' => 'Active',
               'loan_start_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['start']),
               'loan_end_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['end']),
               //$row['date'],
               //'saving_cumulative' => $row['contribution'],
               //'ts_cumulative' => $row['bam'],
               ///'total' => $row['total'],
               //'notes' => $row['description'],
               //'created_by' => auth()->user()->first_name,
        ]);
    }
}
