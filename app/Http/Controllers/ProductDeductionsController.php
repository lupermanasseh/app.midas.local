<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Psubscription;
use App\Productdeduction;
use App\User;
use Carbon\Carbon;
use App\Product;
use App\Exports\ProductdeductionsExport;
use App\Imports\ProductDeductionImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductDeductionsController extends Controller
{
    //
    //list all product subscription deductions
    public function index(){
        $title = 'User Product Deductions';
        $allProductSub = Psubscription::allProductSubscriptions();
        return view ('ProductDeduction.productDeductions', compact('title','allProductSub'));
    }


    public function export(){
        $jstNow = Carbon::now()->toDateString();
        $fileName = 'MIDAS_PRODUCTREPAY_'.$jstNow.'.xlsx';
        return Excel::download(new ProductdeductionsExport(), $fileName);
    }

    //Show uploafd form 
    public function upload(){
        $title = 'Upload Product Deductions';
      return view('ProductDeduction.import',compact('title'));
    }

    public function import(){
        
        try{
      Excel::import(new ProductDeductionImport(),request()->file('product_import'));
        }catch(\Exception $ex){
           toastr()->error('An error has occurred trying to import product deductions');
                return back();
        }catch(\Error $ex){
            toastr()->error('Something bad has happened');
            return back();
        }
      
        toastr()->success('Document uploaded successfully!');
        //redirect to listing page order by latest
        return redirect('/productDeduction/listings');
    
    }

    //Recent Deduction listings
    public function productDeductions(){
        $title = 'Recent Product Deductions';
        //List recent uploads 
        $recent= Productdeduction::with('user','product')->latest()->orderBy('user_id','desc')->paginate(100);
        return view('ProductDeduction.recent',compact('recent','title'));
    }

    //Product Deduction Details
    public function prodDeductionDetails($id){
        $title = 'Product Deduction Details';
        $deductDetails = Productdeduction::deductionDetails($id);
        $productSubDetails =Psubscription::itemDetails($deductDetails->psubscription_id);

        return view ('ProductDeduction.detail',compact('title','deductDetails','productSubDetails'));

    }

    //Edit Product Deductions Records

    public function edit($id){
        $title =  'Edit Product Deduction';
        $deduction = Productdeduction::find($id);
        return view ('ProductDeduction.editProductDeduction',compact('deduction','title'));
    }

    //update product deduction
        public function update(Request $request, $id)
        {
        
        //Save product subscription
        $this->validate(request(), [
            'amount' =>'required|numeric|between:0.00,999999999.99',
            'bank_name' =>'nullable|string',
            'depositor_name'=>'nullable|string',
            'teller_number' =>'nullable|integer',
            'entry_date' =>'required|date',
            ]);

            
                $product_sub = Productdeduction::find($id);
                
                $product_sub->monthly_deduction = $request['amount'];
                $product_sub->bank_name = $request['bank_name'];
                $product_sub->depositor_name = $request['depositor_name'];
                $product_sub->teller_no = $request['teller_number'];
                $product_sub->entry_date = $request['entry_date'];
                $product_sub->uploaded_by = auth()->id();
                $product_sub->save();
                if($product_sub->save()) {
                    toastr()->success('Product deduction updated successfully!');
                    return redirect('/productDeduction/listings');
                }
            
                toastr()->error('An error has occurred trying to update user deduction.');
                return back();
            
      
        }

        //Remove Product Deduction
        public function destroy($id)
        {
            //Delete Product Subscription
            $dlt = Productdeduction::find($id)->delete();
            if($dlt) {
                toastr()->success('Item deleted successfully!');
                return redirect('/productDeduction/listings');
            }
        
            toastr()->error('An error has occurred trying to delete record.');
            return back();
        }

        //Product scheme repay // id is product subscription  id
        public function repay($id){
            $title = 'Product Repayment';
            //find the product from the product subscription table
            $subscription = Psubscription::find($id);
            return view('ProductDeduction.create',compact('title','subscription'));
        }

        //Store product subscription repayment
        public function repayStore(Request $request)
        {
        
        //Save product subscription
        $this->validate(request(), [
            'amount' =>'required|numeric|between:0.00,999999999.99',
            'user_id' =>'required|integer',
            'sub_id' =>'required|integer',
            'product' =>'required|integer',
            'bank_name' =>'required|string',
            'depositor_name'=>'required|string',
            'teller_number' =>'required|string',
            'entry_date' =>'required|date',
            'notes' =>'required|string',
            'bank_add' =>'required|string',
            ]);

            
                $productRepay = new Productdeduction;
                $productRepay->monthly_deduction = $request['amount'];
                $productRepay->bank_name = $request['bank_name'];
                $productRepay->user_id = $request['user_id'];
                $productRepay->product_id = $request['product'];
                $productRepay->psubscription_id = $request['sub_id'];
                $productRepay->entry_date = $request['entry_date'];
                $productRepay->teller_no = $request['teller_number'];
                $productRepay->deduction_mode = $request['mode'];
                $productRepay->depositor_name = $request['depositor_name'];
                $productRepay->notes = $request['notes'];
                $productRepay->bank_add = $request['bank_add'];
                $productRepay->uploaded_by = auth()->id();
                $productRepay->save();
                if($productRepay->save()) {
                    toastr()->success('Product Repayment Successful');
                    return redirect('/prodSub/active');
                }
            
                toastr()->error('An error has occurred trying to record payment.');
                return back();
            
      
        }

}
