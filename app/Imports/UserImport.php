<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
//use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            //
            'membership_type' => $row['m_type'],
            'payment_number' => $row['ippis_no'],
            'staff_no'=> $row['staff_no'],
            'title' => $row['title'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'other_name'=> $row['other_name'],
            'sex' => $row['gender'],
            'dept' => $row['dept'],
            'email' => $row['email'],
            'phone'=> $row['phone_no'],
            'home_add' => $row['address'],
            'dob' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['dob']),
            'dofa' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['dofa']),
            'date_entry' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_created']),
            'employ_type' => $row['employment_type'],
            'job_cadre'=> $row['job_cadre'],
            'marital_status' => $row['status'],
        ]);
    }
}
