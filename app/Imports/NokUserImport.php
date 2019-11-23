<?php

namespace App\Imports;

use App\Nok;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NokUserImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Nok([
            //
            'title' => $row['nok_title'],
            'first_name' => $row['nok_firstname'],
            'last_name' => $row['nok_lastname'],
            'other_name'=> $row['nok_othername'],
            'gender' => $row['nok_sex'],
            'user_id' => $row['reg_no'],
            'email' => $row['nok_email'],
            'phone'=> $row['nok_phone'],
            'relationship' => $row['relationship'],
            //'my_id' => auth()->id(),
        ]);
    }
}
