<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
//use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($status,$end_date,$cadre){
        //$this->pay_type = $pay_type;
        $this->status = $status;
        $this->end_date = $end_date;
        $this->cadre = $cadre;
    }

    // public function collection()
    // {
    //     return User::all();
    // }

    public function view():View
    {
        
        $users = User::filterMembers($this->status,$this->end_date,$this->cadre);
     

        return view('Registration.membersDownload',compact('users'));
    } 
}
