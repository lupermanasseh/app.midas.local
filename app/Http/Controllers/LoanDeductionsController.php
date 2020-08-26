<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lsubscription;
use App\Ldeduction;
use App\Saving;
use App\TargetSaving;
use Carbon\Carbon;
use App\Exports\LoandeductionsExport;
use App\Exports\IppisLoandeductionsExport;
use App\Exports\defaultIppisdeductionsExport;
use App\Exports\defaultIppisPdfExport;
use App\Imports\LoanDeductionImport;
use App\Exports\midasFilterExport;
use App\Exports\loanBalanceExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use PDF;
use GuzzleHttp\Client;

class LoanDeductionsController extends Controller
{

        //Filter loan deductions form
        public function filterDeductions(){
            $title = 'Filter Loan Deductions';
            return view ('LoanDeduction.queryLoanDeduction', compact('title'));
        }

        //Filter loan deductions result
    public function filterLoanResult(Request $request)
        {
        //
            $title = 'User Loan Deductions';
            $this->validate(request(), [
           // 'payment_type' =>'required',
            'start_date' =>'required|date',
            'end_date' =>'required|date',
            ]);

            //$payment_type = $request['payment_type'];
            $start_date = $request['start_date'];
            $end_date = $request['end_date'];
            $loanSub = Lsubscription::filterResult($start_date, $end_date);

            return view ('LoanDeduction.queryResult', compact('title','loanSub','start_date','end_date'));
        }

    //list all loan subscriptions
    public function index(){
        $title = 'User Loan Deductions';
        $loanSub = Lsubscription::loanSubscriptions();
        return view ('LoanDeduction.index', compact('title','loanSub'));
    }

//Export loan deductions in excel format
public function export(){
    $jstNow = Carbon::now()->toDateString();
    $fileName = 'MIDAS_LOANDEDUCTIONS_'.$jstNow.'.xlsx';
    return Excel::download(new LoandeductionsExport(), $fileName);
}

    //list ippis format loan subscriptions
    public function ippis(){
        $title = 'User Loan Deductions';
        $loanSub = Lsubscription::distinctUserLoanSub();
        $activeLoans = Lsubscription::where('loan_status','Active')
                                    ->orWhere('loan_status','Defaulted')
                                    ->with(['user','product'])
                                     ->get();

        return view ('LoanDeduction.ippis', compact('title','loanSub','activeLoans'));
    }

    //DEFAULT IPPIS DOWNLOAD
      public function defaultIppisExport(){
        $jstNow = Carbon::now()->toDateString();
        $fileName = 'IPPIS_LOAN_DEDUCTIONS_'.$jstNow.'.xlsx';
        return Excel::download(new defaultIppisdeductionsExport(), $fileName);
    }


     //IPPIS FILTER DOWNLOAD TEMPLATE
     public function excelFilterExport($start_date,$end_date){
        $jstNow = Carbon::now()->toDateString();
        $fileName = 'MIDAS_IPPISFILTER_LOAN_DEDUCTIONS_'.$jstNow.'.xlsx';
        return Excel::download(new IppisLoandeductionsExport($start_date,$end_date), $fileName);
    }

    //MIDAS FILTER DOWNLOAD TEMPLATE
    public function midasExcelFilterExport($start_date,$end_date){
        $jstNow = Carbon::now()->toDateString();
        $fileName = 'MIDAS_LOAN_DEDUCTIONS_'.$jstNow.'.xlsx';
        return Excel::download(new midasFilterExport ($start_date,$end_date), $fileName);
    }

    //TODO: DEFAULT IPPIS PDF DOWNLOAD

    //upload loan deductions form
    public function importForm(){
        $title = 'Upload Loan Deductions';
      return view('LoanDeduction.midasImport',compact('title'));
    }

    //Import loan deductions
    public function importLoanDeductions(){

        try{
      Excel::import(new LoanDeductionImport(),request()->file('deductions_import'));
        }catch(\Exception $ex){
           toastr()->error('An error has occurred trying to import loan deductions');
                return back();
        }catch(\Error $ex){
            toastr()->error('Something bad has happened');
            return back();
        }

        toastr()->success('Document uploaded successfully!');
        //redirect to listing page order by latest
        return redirect('/loanDeduction/listings');

    }

    //Recent loan deduction upload
    public function loanDeductions(){
        $title = 'Recent Loan Deductions';
        //List recent uploads
        $recent= Ldeduction::with('user')->latest()->orderBy('user_id','desc')->paginate(50);
        return view('LoanDeduction.recentLoanDeduction',compact('recent','title'));
    }

     //User Recent loan deduction upload
     public function userLoanDeductions($id){
        $title = 'User Loan Deductions';
        //List recent uploads
        $recent= Ldeduction::
                            where('user_id',$id)
                            ->paginate(5);
        return view('LoanDeduction.userLoanDeductions',compact('recent','title'));
    }

    public function edit($id){
        $title =  'Edit Loan Deduction';
        $deduction = Ldeduction::find($id);
        return view ('LoanDeduction.editLoanDeduction',compact('deduction','title'));
    }

    //update loan deduction
    public function update(Request $request, $id)
    {

    //Save loan subscription
    $this->validate(request(), [
        'credit' =>'nullable|numeric|between:0.00,999999999.99',
        'debit' =>'nullable|numeric|between:0.00,999999999.99',
        'bank_name' =>'nullable|string',
        'depositor_name'=>'nullable|string',
        'teller_number' =>'nullable|integer',
        'entry_date' =>'required|date',
        'description' =>'required|string',
    ]);

    DB::beginTransaction();
    try{
      $loan_Deduct = Ldeduction::find($id);

      //subscription id//
      $subid = $loan_Deduct->lsubscription_id;

      $loan_Deduct->amount_deducted = $request['credit'];
      $loan_Deduct->amount_debited = $request['debit'];
      $loan_Deduct->bank_name = $request['bank_name'];
      $loan_Deduct->depositor_name = $request['depositor_name'];
      $loan_Deduct->teller_no = $request['teller_number'];
      $loan_Deduct->entry_month = $request['entry_date'];
      $loan_Deduct->uploaded_by = auth()->user()->first_name;
      $loan_Deduct->save();

      //fetch deductions to update balances
      // $loanDeductions = Ldeduction::
      //                    where('lsubscription_id',$subid)
      //                   ->orderBy('id', 'asc')
      //                   ->get();

      $loanDeductions = Ldeduction::
                        where('lsubscription_id',$subid)
                        ->orderBy('entry_month', 'asc')
                        ->get();
              //loop to update balances to zero
              foreach($loanDeductions as $item){
                $deductItem = Ldeduction::find($item->id);
                $deductItem->balances = 0.0;
                $deductItem->save();
              }

              //loop to update actual Balances
              foreach($loanDeductions as $item){
                $loanDeductObj = new Ldeduction;
                //loansubscription object
                $loanSub = new Lsubscription;
                //total loan Balances
                $loanBalances = $this->sumInitialBalances($item->lsubscription_id,$item->entry_month);

                //find individual row
                $deductItem = Ldeduction::find($item->id);
                $credit = $deductItem->amount_deducted;
                $debit = $deductItem->amount_debited;
                  $deductItem->balances = $loanBalances + $credit-$debit;
                  $deductItem->save();

                //check for loan balance
                $loanSub->loanBalance($item->lsubscription_id);
              }
    }
    catch(\Exception $e){
    DB::rollback();
    toastr()->error($e->getMessage());
    return back();
    }
    DB::commit();
    toastr()->success('Record updated successfully!');
    return redirect('/loanDeduction/history/'.$subid);
    }



    //Remove deduction
    public function destroy($id){

      DB::beginTransaction();
      try{
        $loan_Deduct = Ldeduction::find($id);

        //subscription id//
        $subid = $loan_Deduct->lsubscription_id;
        //Delete loan Deduction
        Ldeduction::find($id)->delete();

        //process Balances
        //fetch deductions to update balances
        $loanDeductions = Ldeduction::
                           where('lsubscription_id',$subid)
                          ->orderBy('entry_month', 'asc')
                          ->get();
                //dd($loanDeductions);
                //loop to update balances to zero
                foreach($loanDeductions as $item){
                  $deductItem = Ldeduction::find($item->id);
                  $deductItem->balances = 0.0;
                  $deductItem->save();
                }

                //loop to update actual Balances
                foreach($loanDeductions as $item){
                  $loanDeductObj = new Ldeduction;
                  //loansubscription object
                  $loanSub = new Lsubscription;
                  //total loan Balances
                  $loanBalances = $this->sumInitialBalances($item->lsubscription_id,$item->entry_month);

                  //find individual row
                  $deductItem = Ldeduction::find($item->id);
                  $credit = $deductItem->amount_deducted;
                  $debit = $deductItem->amount_debited;
                    $deductItem->balances = $loanBalances + $credit-$debit;
                    $deductItem->save();

                  //check for loan balance
                  $loanSub->loanBalance($item->lsubscription_id);
                }

      }
      catch(\Exception $e){
      DB::rollback();
      toastr()->error($e->getMessage());
      return back();

      }
      DB::commit();
      toastr()->success('Record removed successfully!');
      return back();
    }

//Debit loan

public function debitLoan(Request $request){

    //Save loan repayment
    $this->validate(request(), [
    'amount' =>'required|numeric|between:0.00,999999999.99',
    'sub_id' =>'required|integer',
    'entry_date' =>'required|date',
    'notes' =>'required|string',
    //'bank_add' =>'required|string',
    ]);

        $subid = $request['sub_id'];

        $loanSub = Lsubscription::find($subid);
        $amtApproved = $loanSub->amount_approved;
        $totalDeductions = $loanSub->totalLoanDeductions($subid);

        //begin transaction to process uploads
        DB::beginTransaction();
        try{
            if($loanSub->loan_status=='Inactive'){
                //check loan
                toastr()->error('This loan is inactive.');
                return redirect('/user/landingPage/'.$loanSub->user_id);
            }else{

                $loanRepay = new Ldeduction;
                //total loan Balances
                $loanBalances = $loanRepay->myLoanDeductions($subid);
                $loanRepay->amount_debited = $request['amount'];
                $loanRepay->balances = $loanBalances - $request['amount'];
              //$loanRepay->bank_name = $request['bank_name'];
                $loanRepay->user_id = $loanSub->user_id;
                $loanRepay->product_id = $loanSub->product_id;
                $loanRepay->lsubscription_id = $subid;
                $loanRepay->entry_month = $request['entry_date'];
                //$loanRepay->teller_no = $request['teller_number'];
              //$loanRepay->depositor_name = $request['depositor_name'];
                $loanRepay->notes = $request['notes'];
                //$loanRepay->bank_add = $request['bank_add'];
                $loanRepay->uploaded_by = auth()->user()->first_name;
                $loanRepay->save();
                //check for loan balance
                $loanSub->loanBalance($subid);
            }
        }
        catch(\Exception $e){
        DB::rollback();
        toastr()->error($e->getMessage());
        //return back();
        return redirect('/user/landingPage/'.$loanSub->user_id);
        }
        DB::commit();
        toastr()->success('Loan debited successfully!');

       return redirect('/loanDeduction/history/'.$subid);
    

}


    //Loan repayment Home
    public function loanPaymentHome($id){
        $title = 'Loan Repayment Home';
      $id = $id;
        return view('LoanDeduction.indexRepay',compact('title','id'));
    }

    /**
     * Loan repay by bank deposit
     * pass in loan subscription id
     */
      public function repay($id){
        $title = 'Loan Repayment';
        //find the loan from the loan subscription table
        $subscription = Lsubscription::find($id);
        return view('LoanDeduction.loanRepay',compact('title','subscription'));
    }

    //Store loan deduction repayment
    public function repayStore(Request $request){

        //Save loan repayment
        $this->validate(request(), [
        'amount' =>'required|numeric|between:0.00,999999999.99',
        'sub_id' =>'required|integer',
        'bank_name' =>'required|string',
        'depositor_name'=>'required|string',
        'teller_number' =>'required|string',
        'entry_date' =>'required|date',
        'notes' =>'required|string',
        'bank_add' =>'required|string',
        ]);

            $subid = $request['sub_id'];

            $loanSub = Lsubscription::find($subid);
            $amtApproved = $loanSub->amount_approved;
            $totalDeductions = $loanSub->totalLoanDeductions($subid);

            //begin transaction to process uploads
            DB::beginTransaction();
            try{
                if($totalDeductions >= $amtApproved){
                    //check loan
                    toastr()->error('An error has occurred trying to repay loan, check please.');
                    return redirect('/user/page/'.$loanSub->user_id);
                }else{

                    $loanRepay = new Ldeduction;
                    //total loan Balances
                    $loanBalances = $loanRepay->myLoanDeductions($subid);
                    $loanRepay->amount_deducted = $request['amount'];
                    $loanRepay->balances = $loanBalances + $request['amount'];
                    $loanRepay->bank_name = $request['bank_name'];
                    $loanRepay->user_id = $loanSub->user_id;
                    $loanRepay->product_id = $loanSub->product_id;
                    $loanRepay->lsubscription_id = $request['sub_id'];
                    $loanRepay->entry_month = $request['entry_date'];
                    $loanRepay->teller_no = $request['teller_number'];
                    $loanRepay->depositor_name = $request['depositor_name'];
                    $loanRepay->notes = $request['notes'];
                    $loanRepay->bank_add = $request['bank_add'];
                    $loanRepay->uploaded_by = auth()->user()->first_name;
                    $loanRepay->save();
                    //check for loan balance
                    $loanSub->loanBalance($subid);
                }
            }
            catch(\Exception $e){
            DB::rollback();
            toastr()->error($e->getMessage());
            return back();
            }
            DB::commit();
            toastr()->success('Loan deduction inputs processed successfully!');
            //redirect to listing page order by latest
            //return redirect('/post/loans');
            return redirect('/loanDeduction/history/'.$request['sub_id']);


    }

    /**
     * Loan repay by savings
     * pass in loan subscription id
     */
    public function savingRepay($id){
        $title = 'Loan Repayment';
        //find the loan from the loan subscription table
        $subscription = Lsubscription::find($id);
        return view('LoanDeduction.loanSavingRepay',compact('title','subscription'));
    }

    public function savingRepayStore(Request $request){
        //validation
        $this->validate(request(), [
            'amount' =>'required|numeric|between:0.00,999999999.99',
            'sub_id' =>'required|integer',
            'entry_date' =>'required|date',
            'notes' =>'required|string',
            ]);

            //variables
            $amt = $request['amount'];
            $sub_id = $request['sub_id'];
            $date = $request['entry_date'];
            $notes = $request['notes'];
            $subscription = Lsubscription::find($sub_id);
            $user_id = $subscription->user_id;

            //check balance on loan
            $amt_approved = $subscription->amount_approved;
            $total_Deductions = $subscription->totalLoanDeductions($sub_id);

            if($total_Deductions >= $amt_approved){
                toastr()->error('It seems you do not have any balance on this loan.');
                return redirect('/user/page/'.$user_id);
            }

            $saving = new Saving;
            if($amt < $saving->netBalance($user_id)){

            DB::beginTransaction();

            try{
            //Step 1 : debit savings account
            $saving->amount_withdrawn = $amt;
            $saving->balances = $saving->netBalance($user_id)-$amt;
            $saving->entry_date = $date;
            $saving->user_id = $user_id;
            $saving->notes = 'Paying loan from my savings account';
            $saving->created_by = auth()->id();
            $saving->save();
            }catch(\Exception $e){
            DB::rollback();
            toastr()->error('An error has occurred trying to debit your account.');
            return back();
            }

            try{
            //Create new loan deduction
            $loanDeduction = new Ldeduction;
            $loanDeduction->user_id = $user_id;
            $loanDeduction->product_id = $subscription->product_id;
            $loanDeduction->lsubscription_id = $sub_id;
            $loanDeduction->amount_deducted = $amt;
            $loanDeduction->balances = $total_Deductions + $amt;
            $loanDeduction->entry_month = $date;
            $loanDeduction->notes = $notes;
            $loanDeduction->uploaded_by = auth()->user()->first_name;
            $loanDeduction->save();
            //check for loan balance
            $subscription->loanBalance($sub_id);
            }catch(\Exception $e){
            DB::rollback();
            toastr()->error($e->getMessage());
            return back();
            }
            DB::commit();
            $phone = $subscription->user->phone;
            $product = $subscription->product->name;
            $balanceOnLoan = number_format($subscription->amount_approved-$subscription->totalLoanDeductions($sub_id),2,'.',',');
            $netSavingBalance = number_format($saving->netBalance($user_id),2,'.',',');

                        //send saving debit message
                        $client = new Client;
                        $api = '9IGspBnLAjWENmr9nPogQRN9PuVwAHsSPtGi5szTdBfVmC2leqAe8vsZh6dg';
                        $to = $phone;
                        $from= 'MIDAS';
                        $message = 'Debit notification. Acct: Savings. Amount: N' .$amt.'. Balance: N'. $netSavingBalance;
                       $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create?api_token='.$api.'&from='.$from.'&to='.$to.'&body='.$message.'&dnd=1';

                       $response = $client->request('GET', $url,['verify'=>false]);

                        //send loan deduction notification

                        $client = new Client;
                        $api = '9IGspBnLAjWENmr9nPogQRN9PuVwAHsSPtGi5szTdBfVmC2leqAe8vsZh6dg';
                        $to = $phone;
                        $from= 'MIDAS';
                        $message = 'Loan Deduction notification. Product: '.$product. '  Amount: N' .$amt.'. Balance: N'. $balanceOnLoan;
                       $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create?api_token='.$api.'&from='.$from.'&to='.$to.'&body='.$message.'&dnd=1';

                       $response = $client->request('GET', $url,['verify'=>false]);

                       //redirect to user loan deduction page
                        toastr()->success('Loan Repayment Successful');
                        return redirect('/loanDeduction/history/'.$sub_id);

            }else{
                toastr()->error('you dont have enough balance on your savings account.');
                return back();
            }
    }


       /**
     * Loan repay by target savings
     * pass in loan subscription id
     */
    public function tsRepay($id){
        $title = 'Loan Repayment';
        //find the loan from the loan subscription table
        $subscription = Lsubscription::find($id);
        return view('LoanDeduction.loanTsRepay',compact('title','subscription'));
    }

    /**
     * target saving loan payment
     * store method
     */
    public function tsRepayStore(Request $request){
        //validation
        $this->validate(request(), [
            'amount' =>'required|numeric|between:0.00,999999999.99',
            'sub_id' =>'required|integer',
            'entry_date' =>'required|date',
            'notes' =>'required|string',
            ]);

            //variables
            $amt = $request['amount'];
            $sub_id = $request['sub_id'];
            $date = $request['entry_date'];
            $notes = $request['notes'];
            $subscription = Lsubscription::find($sub_id);
            $user_id = $subscription->user_id;

            //check balance
            //check balance on loan
            $amt_approved = $subscription->amount_approved;
            $total_Deductions = $subscription->totalLoanDeductions($sub_id);

            $targetSaving = new TargetSaving;
            $ts_id = $targetSaving->activeTargetsr($user_id);

            if($ts_id==""){
                toastr()->error('You do not have an active target saving subscription. Choose another payment channel');
                return redirect('/loan/payment/'.$sub_id);
            }

            if($total_Deductions >= $amt_approved){
                toastr()->error('It seems you do not have any balance on this loan.');
                return redirect('/user/page/'.$user_id);
            }

            if($amt < $targetSaving->targetSavingBalance($ts_id)){

            DB::beginTransaction();

            try{
            //Step 1 : debit target savings account
            $targetSaving->withdrawal = $amt;
            $targetSaving->entry_date = $date;
            $targetSaving->user_id = $user_id;
            $targetSaving->targetsr_id = $ts_id;
            $targetSaving->notes = 'Paying loan from my target savings account';
            $targetSaving->created_by = auth()->id();
            $targetSaving->save();
            }catch(\Exception $e){
            DB::rollback();
            toastr()->error('An error has occurred trying to debit your account.');
            return back();
            }

            try{
            //Create new loan deduction
            $loanDeduction = new Ldeduction;
            $loanDeduction->user_id = $user_id;
            $loanDeduction->product_id = $subscription->product_id;
            $loanDeduction->lsubscription_id = $sub_id;
            $loanDeduction->amount_deducted = $amt;
            $loanDeduction->entry_month = $date;
            $loanDeduction->notes = $notes;
            $loanDeduction->uploaded_by = auth()->id();
            $loanDeduction->save();
            }catch(\Exception $e){
            DB::rollback();
            toastr()->error('An error has occurred trying to persist your deductions.');
            return back();
            }
            DB::commit();
            $phone = $subscription->user->phone;
            $product = $subscription->product->name;
            $balanceOnLoan = number_format($subscription->amount_approved-$subscription->totalLoanDeductions($sub_id),2,'.',',');
            $tsBalance = number_format($targetSaving->targetSavingBalance($ts_id),2,'.',',');

                        //send saving debit message
                        $client = new Client;
                        $api = '9IGspBnLAjWENmr9nPogQRN9PuVwAHsSPtGi5szTdBfVmC2leqAe8vsZh6dg';
                        $to = $phone;
                        $from= 'MIDAS';
                        $message = 'Debit notification. Acct: Target Savings. Amount: N' .$amt.'. Balance: N'. $tsBalance;
                       $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create?api_token='.$api.'&from='.$from.'&to='.$to.'&body='.$message.'&dnd=1';

                       $response = $client->request('GET', $url,['verify'=>false]);


                        //send loan deduction notification

                        $client = new Client;
                        $api = '9IGspBnLAjWENmr9nPogQRN9PuVwAHsSPtGi5szTdBfVmC2leqAe8vsZh6dg';
                        $to = $phone;
                        $from= 'MIDAS';
                        $message = 'Loan Deduction notification. Product: '.$product. '  Amount: N' .$amt.'. Balance: N'. $balanceOnLoan;
                       $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create?api_token='.$api.'&from='.$from.'&to='.$to.'&body='.$message.'&dnd=1';

                       $response = $client->request('GET', $url,['verify'=>false]);

                       //redirect to user loan deduction page
                        toastr()->success('Loan Repayment Successful');
                        return redirect('/loanDeduction/history/'.$sub_id);

            }else{
                toastr()->error('You dont have enough balance on your savings account.');
                return back();
            }
    }



    /**
     * Loan Deduction History
     * pass in loan subscription ID
     */
    public function loanDeductionHistory($id){
        $title = 'Loan Deduction History';
        $loan = Lsubscription::find($id);
        $loanHistory = Ldeduction::loanHistory($id);
        return view ('LoanDeduction.loanHistory',compact('title','loanHistory','loan'));

    }

     //print loan deductions to file
     public function loanDeductionsPrint($id){
        $title = 'Loan Deductions History';
        $loan = Lsubscription::find($id);
        $loanHistory = Ldeduction::loanHistory($id);
        //$userObj = User::find($loan->user_id);
        return view('Prints.loan_deductions_print',compact('title','loan','loanHistory'));
    }

    //print loan deduction to pdf
    public function loanDeductionsPdf($id){
        $title = 'Loan Deductions History';
        $loan = Lsubscription::find($id);
        $loanHistory = Ldeduction::loanHistory($id);
        //$userObj = User::find($loan->user_id);

        $pdf = PDF::loadView('Prints.loan_deductions_pdf',compact('loan','title','loanHistory'));
        return $pdf->stream();
    }

    //form to find loan Balances  //upload loan deductions form
      public function findLoanBalances(){
          $title = 'Find Loan Balances';
        return view('LoanDeduction.loanBalancesFind',compact('title'));
      }

    //find loan balances liability
    public function LoanBalancesResult(Request $request){
        $title = 'Loan Deduction Balances';
        $loanDeductionObj = new Ldeduction;
        $this->validate(request(), [
            'from' =>'required|date',
             'to' =>'required|date',
             ]);
             $from = $request['from'];
             $to = $request['to'];
        $loanDeductionCollection = $loanDeductionObj->findLoanDeductionByDate($from,$to);
        // $contributors = Saving::where('status','Active')
        //                         ->orderBy('user_id','asc')
        //                         ->get();
        $uniqueDebtors = $loanDeductionCollection->unique('user_id');
        return view('LoanDeduction.loanBalancesResult',compact('title','loanDeductionCollection','to','from','$loanDeductionObj','uniqueDebtors'));
    }

    //download in excel format loan Balances
    public function loanBalancesExcelExport($from,$to){
        $fileName = 'MIDAS_LOANBALANCES_'.$to.'.xlsx';
        return Excel::download(new loanBalanceExport($from,$to), $fileName);
    }

    //download in PDF format loan Balances
    public function loanBalancesPdf($from,$to){
        $title='Loan Deduction Balances';
        $loanDeductionObj = new Ldeduction;

        $loanDeductionCollection = $loanDeductionObj->findLoanDeductionByDate($from,$to);

        $uniqueDebtors = $loanDeductionCollection->unique('user_id');
        $pdf= PDF::loadView('Prints.loan_balances_pdf',compact('loanDeductionCollection','to','from','$loanDeductionObj','uniqueDebtors'));
        return $pdf->stream();
    }


//method to sum initial zero balabces after and update or deleted

public function sumInitialBalances($subid,$entry_date)
{
  $loanDeductions = Ldeduction::
                     where('lsubscription_id',$subid)
                     ->where('entry_month','<',$entry_date)
                     ->orderBy('entry_month', 'asc')
                     ->get();
                  //Find sum of credit and debit to calcultae balance
                    $credit = $loanDeductions->sum('amount_deducted');
                    $debit = $loanDeductions->sum('amount_debited');
                    return $balance = $credit - $debit;
}

}
