<?php

namespace App\Imports;

use App\Targetsr;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TsUserImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Targetsr([
            //
            'current_amount' => $row['contribution'],
            'user_id' => $row['reg_no'],
        ]);
    }
}
