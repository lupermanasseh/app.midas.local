<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loan;

class LoanProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //List all products
        $title ='All Loan Products';
        $loanProducts = Loan::orderBy('tenor','asc')->paginate(10);
        return view('LoanProducts.index',compact('loanProducts','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Add Loan Product";
        return view ('LoanProducts.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Save Loan Product
        $this->validate(request(), [
        'loan_name' =>'required|string',
        'tenor'=>'required|integer',
        'interest' =>'required|numeric|between:0.00,999999999.99',
        ]);
        
        $loanProduct = new Loan();
        $loanProduct->description = $request['loan_name'];
        $loanProduct->tenor = $request['tenor'];
        $loanProduct->interest = $request['interest'];

        $loanProduct->save();
    
        if($loanProduct->save()) {
            toastr()->success('Loan Product has been saved successfully!');
            return redirect('/loanProduct/create');
        }
    
        toastr()->error('An error has occurred trying to save, please try again later.');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $title ='Edit Product';
        $loanPrdt = Loan::find($id);
        return view('LoanProducts.editLoanProduct',compact('loanPrdt','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate(request(), [
            'loan_name' =>'required|string',
            'tenor'=>'required|integer',
            'interest' =>'required|numeric|between:0.00,999999999.99',
            ]);

            $loanProduct = Loan::find($id);
            $loanProduct->description = $request['loan_name'];
            $loanProduct->tenor = $request['tenor'];
            $loanProduct->interest = $request['interest'];
    
            $loanProduct->save();
        
            if($loanProduct->save()) {
                toastr()->success('Loan Product has been modified successfully!');
                return redirect('/loanProducts');
            }
        
            toastr()->error('An error has occurred trying to modify resource, please try again later.');
            return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
