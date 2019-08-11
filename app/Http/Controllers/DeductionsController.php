<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeductionsController extends Controller
{
    //
    //Master deductions for IPPIS upload
    public function index(){
        $title = 'Master IPPIS Deductions';
        return view ('Deductions.master',compact('title'));
    }
}
