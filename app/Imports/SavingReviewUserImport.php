<?php

namespace App\Imports;

use App\Savingreview;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class SavingReviewUserImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Savingreview([
            //
            'current_amount' => $row['contribution'],
            'user_id' => $row['reg_no'],
            'created_by' => auth()->user()->first_name,
        ]);
    }
}
