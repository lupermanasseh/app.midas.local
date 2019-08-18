<?php

namespace App\Imports;

use App\Bank;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BankUserImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Bank([
            //
            'bank_name' => $row['bank'],
            'acct_number' => $row['acct_no'],
            'user_id' => $row['reg_no'],
        ]);
    }
}
