<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Savingmaster extends Model
{
    //
    protected $fillable = [
        'name', 
        'ippis_no', 
        'saving_cumulative',
        'ts_cumulative',
        'total',
        'status',
        'entry_date',
        'created_by',
    ];
    protected $dates = ['created_at', 'updated_at','entry_date'];
}
