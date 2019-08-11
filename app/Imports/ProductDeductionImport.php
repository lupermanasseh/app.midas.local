<?php

namespace App\Imports;

use App\Productdeduction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
//use Maatwebsite\Excel\Concerns\WithBatchInserts;
//use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductDeductionImport implements ToModel,WithHeadingRow //, WithBatchInserts, 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Productdeduction([
            //
            'user_id' => $row['user_id'],
            'product_id' => $row['product_id'],
            'psubscription_id' => $row['subscription_id'],
            'entry_date' => $row['date'],
            'monthly_deduction' => $row['monthly_repay'],
            'uploaded_by' => auth()->id(),

        ]);
    }
}
