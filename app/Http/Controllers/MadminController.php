<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Lsubscription;


class MadminController extends Controller
{
    //
    public function index (){
        $title ="Dashboard Home";
        return view('Madmin.index')->with('title',$title);
    }
    //Cooperators
    public function cooperators(){

    return view('Madmin.index',compact());
    
    }

    //Steering Committtee
    // public function committee (){
    //     $title ="Steering Committee";
    //     return view('Home.committee')->with('title',$title);
    // }

    //Board
    // public function board (){
    //     $title ="Board Members";
    //     return view('Home.board')->with('title',$title);
    // }

    //products
    // public function products (){
    //     $title = "Our Products";
    //     return view('Home.products')->with('title',$title);
    // }
}
