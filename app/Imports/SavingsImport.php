<?php

namespace App\Imports;

use App\Saving;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
//use Maatwebsite\Excel\Concerns\WithBatchInserts;
//use Maatwebsite\Excel\Concerns\WithChunkReading;

class SavingsImport implements ToModel, WithHeadingRow //, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //We can use column numbers and columns names for import as seein below
        return new Saving([
            //
            'user_id' => $row['user_id'],
            'amount_saved' => $row['amount'],
            'entry_date' => $row['date'],
            'notes'=> $row['description'],
            'created_by' => auth()->id(),
        ]);

        // return new Saving([
        //     //
        //     'user_id' => $row['user_id'],
        //     'amount_saved' => $row['amount'],
        //     'entry_date' => $row['date'],
        //     'created_by' => $row['staff_id'],
        // ]);
    }

    // public function headingRow():init
    // {
    //     return 1;
    // }

    // public function batchSize():init
    // {
    //    return 1000;
    // }

    // public function chunkSize():init
    // {
    //    return 1000;
    // }
}
