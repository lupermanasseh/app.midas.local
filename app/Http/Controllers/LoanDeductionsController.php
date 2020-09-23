<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lsubscription;
use App\Ldeduction;
use App\Saving;
use App\User;
use App\Masterdeduction;
use App\TargetSaving;
use App\Userconsolidatedloan;
use Carbon\Carbon;
use App\Exports\LoandeductionsExport;
use App\Exports\IppisLoandeductionsExport;
use App\Exports\defaultIppisdeductionsExport;
use App\Exports\defaultIppisPdfExport;
use App\Imports\LoanDeductionImport;
use App\Exports\midasFilterExport;
use App\Exports\loanBalanceExport;
use App\Exports\userConsolidatedLoanLedgerExport;
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

//populate user consolidated loans table
public function populate(){
//1
  // DB::table('lsubscriptions')->where('loan_status', '<>','restructured')
  //                           ->orderBy('disbursement_date','asc')
  //   ->chunkById(300, function ($users) {
  //       foreach ($users as $user) {
  //         $now = Carbon::now()->toTimeString();
  //         //$date = $user->disbursement_date." ".$now;
  //         $recordId = $user->id;
  //         //inser records
  //         $newData = new Userconsolidatedloan();
  //         $newData->user_id = $user->user_id;
  //         $newData->lsubscription_id = $user->id;
  //         $newData->description = 'Normal Loan Disbursement';
  //         $newData->date_entry = $user->disbursement_date;
  //         $newData->entry_time = $now;
  //         $newData->debit = $user->amount_approved;
  //         $newData->save();
  //
  //         if($user->topup_amount){
  //
  //           DB::table('ldeductions')->where('lsubscription_id',$recordId)
  //                                 ->where('notes','Top up loan')
  //                                 ->orderBy('entry_month', 'asc')
  //                                   ->chunkById(100, function ($collections) {
  //                                     foreach ($collections as $collection) {
  //                                       $now = Carbon::now()->toTimeString();
  //                                       //$date = $collection->entry_month." ".$now;
  //                                       $newData = new Userconsolidatedloan();
  //                                       $newData->user_id = $collection->user_id;
  //                                       $newData->lsubscription_id = $collection->lsubscription_id;
  //                                       $newData->description = $collection->notes;
  //                                       $newData->date_entry = $collection->entry_month;
  //                                       $newData->entry_time = $now;
  //                                       $newData->debit = $collection->amount_debited;
  //                                       $newData->save();
  //               }
  //         });
  //
  //
  //
  //         }
  //       }
  //   });


    //2
  //   DB::table('ldeductions')->whereNull('deduct_reference')
  //                           ->orderBy('entry_month', 'asc')
  //                           ->chunkById(100, function ($collections) {
  //                             foreach ($collections as $collection) {
  //                               $now = Carbon::now()->toTimeString();
  //                               //$date = $collection->entry_month." ".$now;
  //                               $newData = new Userconsolidatedloan();
  //                               $newData->user_id = $collection->user_id;
  //                               $newData->lsubscription_id = $collection->lsubscription_id;
  //                               $newData->description = $collection->notes;
  //                               $newData->date_entry = $collection->entry_month;
  //                               $newData->entry_time = $now;
  //                               $newData->debit = $collection->amount_debited;
  //                               $newData->credit = $collection->amount_deducted;
  //                               $newData->save();
  //       }
  // });

  //3
//     DB::table('masterdeductions')->where('status','Inactive')
//     ->orderBy('entry_date', 'asc')
//     ->chunkById(500, function ($collections) {
//       foreach ($collections as $collection) {
//         $now = Carbon::now()->toTimeString();
//
//         //find user id using ippis number
//         $userID = User::userID($collection->ippis_no);
//         $newData = new Userconsolidatedloan();
//         $newData->user_id = $userID;
//         $newData->description = $collection->description;
//         $newData->date_entry = $collection->entry_date;
//         $newData->entry_time = $now;
//         $newData->ref_identification = $collection->master_reference;
//         $newData->credit = $collection->cumulative_amount;
//         $newData->save();
// }
// });


//4

// $uniqueDebtors = Userconsolidatedloan::all()->SortBy('user_id')->unique('user_id');
// foreach($uniqueDebtors as $debtor){
//   $newConsolidatedBalance = new Userconsolidatedloan();
//   $newConsolidatedBalance->userConsolidatedBalances($debtor->user_id);
// }

//Test guarantor dashboard
// $g1 = Lsubscription::where('guarantor_id1', '=', $id)
//                    ->count();
// $g2 = Lsubscription::where('guarantor_id2', '=', $id)
//                    ->count();
//          return $g1+$g2;




// $g1 = DB::table('lsubscriptions')->where('guarantor_id1')->pluck('guarantor_id1');
// $g2 = DB::table('lsubscriptions')->whereNotNull('guarantor_id2')->pluck('guarantor_id2');
// $concatenated = $g1->concat($g2);
// $uniqueGuarantors = $concatenated->unique();


//
// $gs = DB::table('users')->select('photo')
//                         ->where('id',4)
//                         ->whereNotNull('photo')
//                         ->get();
//   $g =  $gs->count();


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


//edit consolidated loan deduction form
public function editConsolidatedLoanDeduction($id){
    $title =  'Edit Consolidated Loan Deduction';
    $deduction = Userconsolidatedloan::find($id);
    return view ('LoanDeduction.editConsolidatedLoanDeduction',compact('deduction','title'));
}

//update consolidated loan deduction

public function updateConsolidatedLoanDeduction(Request $request, $id)
{

//Save loan subscription
$this->validate(request(), [
    'credit' =>'nullable|numeric|between:0.00,999999999.99',
    'debit' =>'nullable|numeric|between:0.00,999999999.99',
    'entry_date' =>'required|date',
    'description' =>'required|string',
]);

DB::beginTransaction();
try{
  $loan_Deduct = Userconsolidatedloan::find($id);

  //subscription id//
  $userid = $loan_Deduct->user_id;
  $now = Carbon::now()->toTimeString();
  $loan_Deduct->credit= $request['credit'];
  $loan_Deduct->debit = $request['debit'];
  $loan_Deduct->description = $request['description'];
  $loan_Deduct->date_entry = $request['entry_date'];
  $loan_Deduct->entry_time = $now;
  //$loan_Deduct->uploaded_by = auth()->user()->first_name;
  $loan_Deduct->save();

  //recalculate loan balances
  $loan_Deduct->userConsolidatedBalances($userid);
}
catch(\Exception $e){
DB::rollback();
toastr()->error($e->getMessage());
return back();
}
DB::commit();
toastr()->success('Record updated successfully!');
return redirect('/user/landingPage/'.$userid);
}


//delete consolidated loan deduction

public function removeConsolidatedLoanDeduction($id){

  DB::beginTransaction();
  try{
    $loan_Deduct = Userconsolidatedloan::find($id);

    //user id//
    $userid = $loan_Deduct->user_id;
    //Delete loan Deduction
    Userconsolidatedloan::find($id)->delete();


    //recalculate loan balances
    $loan_Deduct->userConsolidatedBalances($userid);

  }
  catch(\Exception $e){
  DB::rollback();
  toastr()->error($e->getMessage());
  return redirect('/user/landingPage/'.$userid);
  }
  DB::commit();
  toastr()->success('Record removed successfully!');
  return redirect('/user/landingPage/'.$userid);
}


    public function edit($id){
        $title =  'Edit Loan Deduction';
        $deduction = Ldeduction::find($id);
        return view ('LoanDeduction.editLoanDeduction',compact('deduction','title'));
    }

    //update loan deduction procedure
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

      //recalculate loan balances
      $loan_Deduct->recalculateLoanDeductionBalances($subid);
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

        //recalculate loan balances
        $loan_Deduct->recalculateLoanDeductionBalances($subid);

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
        $userId = $loanSub->user_id;

        $amtApproved = $loanSub->amount_approved;
        // $totalDeductions = $loanSub->totalLoanDeductions($subid);

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
                $now = Carbon::now()->toTimeString();
                $loanBalances = $loanRepay->myLoanDeductions($subid);
                $loanRepay->amount_debited = $request['amount'];
                $loanRepay->balances = $loanBalances - $request['amount'];

                $loanRepay->user_id = $loanSub->user_id;
                $loanRepay->product_id = $loanSub->product_id;
                $loanRepay->lsubscription_id = $subid;
                $loanRepay->entry_month = $request['entry_date'];
                $loanRepay->entry_time = $now;
                $loanRepay->notes = $request['notes'];
                $loanRepay->uploaded_by = auth()->user()->first_name;
                $loanRepay->save();


                //recalculate loan balances
                $loanRepay->recalculateLoanDeductionBalances($subid);

                // //post debit amount to consolidated loan ledger
                //
                $newConsolidatedDeduct = new Userconsolidatedloan();

                $newConsolidatedDeduct->user_id = $userId;
                $newConsolidatedDeduct->description = $request['notes'];
                $newConsolidatedDeduct->date_entry = $request['entry_date'];
                $newConsolidatedDeduct->entry_time = $now;
                $newConsolidatedDeduct->debit = $request['amount'];
                $newConsolidatedDeduct->save();
                $newConsolidatedDeduct->userConsolidatedBalances($userId);
            }
        }
        catch(\Exception $e){
        DB::rollback();
        toastr()->error($e->getMessage());
        //return back();
        return redirect('/user/landingPage/'.$userId);
        }
        DB::commit();

        toastr()->success('Loan debited successfully!');

       return redirect('/loanDeduction/history/'.$subid);


}

//top up loans

public function topUpLoan(Request $request){

    //Save loan repayment
    $this->validate(request(), [
    'deduction' =>'nullable|numeric|between:0.00,999999999.99',
    'tenor' =>'nullable|numeric|between:1,60',
    'start_date' =>'nullable|date',
    'end_date' =>'nullable|date',
    'transaction_date' =>'required|date',
    'parent_loan' =>'required|integer',
    'amount' =>'required|numeric|between:0.00,999999999.99',
    //'bank_add' =>'required|string',
    ]);

        $deduction = $request['deduction'];
        $tenor = $request['tenor'];
        $start_date = $request['start_date'];
        $end_date = $request['end_date'];
        $transaction_date = $request['transaction_date'];
        $parent_loan_id = $request['parent_loan'];
        $topupAmt = $request['amount'];


        $parentLoan = Lsubscription::find($parent_loan_id);

        //parent loan amount
        $parentLoanAmt = $parentLoan->amount_approved;

//money format
//$english_format_number = number_format($number, 2, '.', '');
        //
        if($start_date){
            $start_date = $start_date;
        }else{
            $start_date = $parentLoan->loan_start_date;
        }

        if($end_date){
            $end_date = $end_date;
        }else{
            $end_date = $parentLoan->loan_end_date;
        }

        if($tenor){
            $tenor = $tenor;
        }else{
            $tenor = $parentLoan->custom_tenor;
        }

        if($deduction){
            $feduction = $deduction;
        }else{
          $deduction = $parentLoanAmt + $topupAmt;
          $fdeduction = $deduction/$tenor;
        }

//check if parent loan has a top up amount
//if yes add the new top up amount to it else save new topup amount
  if($parentLoan->topup_amount){
    $newTopUp = $parentLoan->topup_amount + $topupAmt;
  }else{
    $newTopUp = $topupAmt;
  }


        //begin transaction to process loan topup
        DB::beginTransaction();
        try{
            if($parentLoan->loan_status=='Inactive'){
                //check loan
                toastr()->error('This loan is already inactive, top up is impossible.');
                return redirect('/user/landingPage/'.$parentLoan->user_id);
            }else{
                //create new loan with the merged data
                $loan_sub = new Lsubscription();
                $loan_sub->product_id = $parentLoan->product_id;
                $loan_sub->user_id = $parentLoan->user_id;
                $loan_sub->guarantor_id1 = $parentLoan->guarantor_id1;
                $loan_sub->guarantor_id2 = $parentLoan->guarantor_id2;
                $loan_sub->monthly_deduction = $fdeduction;
                $loan_sub->custom_tenor = $tenor;
                $loan_sub->amount_applied = $parentLoan->amount_applied;
                $loan_sub->topup_amount = $newTopUp;
                $loan_sub->amount_approved = $parentLoan->amount_approved;
                $loan_sub->units = $parentLoan->units;
                $loan_sub->loan_start_date = $start_date;
                $loan_sub->loan_end_date = $end_date;
                $loan_sub->disbursement_date = $parentLoan->disbursement_date;
                $loan_sub->approved_date = $parentLoan->approved_date;
                $loan_sub->review_comment = $parentLoan->review_comment;
                $loan_sub->review_by = auth()->user()->first_name;
                $loan_sub->review_date = $parentLoan->review_date;
                $loan_sub->net_pay = $parentLoan->net_pay;
                $loan_sub->loan_status = 'Active';
                $loan_sub->created_by = auth()->user()->first_name;
                $loan_sub->save();

                //get the id of the merged loan
                $mergedLoanId = $loan_sub->id;

                //update/merged deductions of the old loan if any
                Ldeduction::where('lsubscription_id','=', $parent_loan_id)
                            ->update(['lsubscription_id' => $mergedLoanId]);

                //change the status of the parent loan to restructured
                $parentLoan->loan_status = 'Restructured';
                $parentLoan->save();


                  //debit the loan to the tune of top amount

                    $loanDeduction = new Ldeduction;
                    //total loan Balances
                      $now = Carbon::now()->toTimeString();
                    $loanBalances = $loanDeduction->myLoanDeductions($mergedLoanId);
                    $loanDeduction->amount_debited = $topupAmt;
                    $loanDeduction->balances = $loanBalances - $topupAmt;

                    $loanDeduction->user_id = $parentLoan->user_id;
                    $loanDeduction->product_id = $parentLoan->product_id;
                    $loanDeduction->lsubscription_id = $mergedLoanId;
                    $loanDeduction->entry_month = $transaction_date;
                    $loanDeduction->entry_time = $now;

                    $loanDeduction->notes = 'Top up loan';

                    $loanDeduction->uploaded_by = auth()->user()->first_name;
                    $loanDeduction->save();

                //recaculate loan balances
                $loanDeduction->recalculateLoanDeductionBalances($mergedLoanId);

                // //post cumulative amount to consolidated loan ledger
                //
                $newConsolidatedDeduct = new Userconsolidatedloan();


                $newConsolidatedDeduct->user_id = $parentLoan->user_id;
                $newConsolidatedDeduct->description = 'Top up loan';
                $newConsolidatedDeduct->date_entry = $transaction_date;
                $newConsolidatedDeduct->entry_time = $now;
                $newConsolidatedDeduct->debit = $topupAmt;
                $newConsolidatedDeduct->save();
                $newConsolidatedDeduct->userConsolidatedBalances($parentLoan->user_id);

            }
        }
        catch(\Exception $e){
        DB::rollback();
        toastr()->error($e->getMessage());
        //return back();
        return redirect('/user/landingPage/'.$parentLoan->user_id);
        }
        DB::commit();
        toastr()->success('Loan top up operation successful!');
         return redirect('/user/landingPage/'.$parentLoan->user_id);
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

    //Store loan deduction/bank repayment
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
                    toastr()->error('Loan seems fully paid, check please.');
                    return redirect('/user/page/'.$loanSub->user_id);
                }else{

                    $loanRepay = new Ldeduction;
                    //total loan Balances
                    $now = Carbon::now()->toTimeString();
                    $loanBalances = $loanRepay->myLoanDeductions($subid);
                    $loanRepay->amount_deducted = $request['amount'];
                    $loanRepay->balances = $loanBalances + $request['amount'];
                    $loanRepay->bank_name = $request['bank_name'];
                    $loanRepay->user_id = $loanSub->user_id;
                    $loanRepay->product_id = $loanSub->product_id;
                    $loanRepay->lsubscription_id = $request['sub_id'];
                    $loanRepay->entry_month = $request['entry_date'];
                    $loanRepay->entry_time = $now;
                    $loanRepay->teller_no = $request['teller_number'];
                    $loanRepay->depositor_name = $request['depositor_name'];
                    $loanRepay->notes = $request['notes'];
                    $loanRepay->bank_add = $request['bank_add'];
                    $loanRepay->uploaded_by = auth()->user()->first_name;
                    $loanRepay->save();

                    //recalculate Balances
                    $loanRepay->recalculateLoanDeductionBalances($subid);

                    // //post cumulative amount to consolidated loan ledger
                    //
                    $newConsolidatedDeduct = new Userconsolidatedloan();


                    $newConsolidatedDeduct->user_id = $loanSub->user_id;
                    $newConsolidatedDeduct->description = $request['notes'];
                    $newConsolidatedDeduct->date_entry = $request['entry_date'];
                    $newConsolidatedDeduct->entry_time = $now;
                    $newConsolidatedDeduct->credit = $request['amount'];
                    $newConsolidatedDeduct->save();
                    $newConsolidatedDeduct->userConsolidatedBalances($loanSub->user_id);
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
            $now = Carbon::now()->toTimeString();
            $loanDeduction->user_id = $user_id;
            $loanDeduction->product_id = $subscription->product_id;
            $loanDeduction->lsubscription_id = $sub_id;
            $loanDeduction->amount_deducted = $amt;
            $loanDeduction->balances = $total_Deductions + $amt;
            $loanDeduction->entry_month = $date;
            $loanDeduction->entry_time = $now;
            $loanDeduction->notes = $notes;
            $loanDeduction->uploaded_by = auth()->user()->first_name;
            $loanDeduction->save();

            //recalculate balances

            $loanDeduction->recalculateLoanDeductionBalances($sub_id);

            // //post cumulative amount to consolidated loan ledger
            //
            $newConsolidatedDeduct = new Userconsolidatedloan();

            $newConsolidatedDeduct->user_id =$user_id;
            $newConsolidatedDeduct->description = $notes;
            $newConsolidatedDeduct->date_entry = $date;
            $newConsolidatedDeduct->entry_time = $now;
            $newConsolidatedDeduct->credit = $amt;

            $newConsolidatedDeduct->save();
            $newConsolidatedDeduct->userConsolidatedBalances($user_id);

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
        $activeLoans = Lsubscription::activeLoans($loan->user_id);
        //User target saving subscriptions
        return view ('LoanDeduction.loanHistory',compact('title','loanHistory','loan','activeLoans'));

    }

     //print loan deductions to file
     public function loanDeductionsPrint($id){
        $title = 'Loan Deductions History';
        $loan = Lsubscription::find($id);
        $loanHistory = Ldeduction::loanHistory($id);

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

    //consolidated loan deductions print file
    public function consolidatedLoanDeductionsPrint($id){
      $title ="Consolidated Loan History";
      $user = User::find($id);
      $consolidatedLoans = Userconsolidatedloan::getConsolidatedLoanBalances($id);

      return view('Prints.consolidatedloan_deductions_print',compact('title','consolidatedLoans','user'));
    }

    //individual consolidated loan deductions print pdf
    public function consolidatedLoanDeductionsPdf($id){
      $title ="Consolidated Loan History";
      $user = User::find($id);
      $consolidatedLoans = Userconsolidatedloan::getConsolidatedLoanBalances($id);

      $pdf = PDF::loadView('Prints.consolidatedloan_deductions_pdf',compact('title','consolidatedLoans','user'));
      return $pdf->stream();
    }




    //form to find loan individual Balances
      public function findLoanBalances(){
          $title = 'Find Loan Balances';
        return view('LoanDeduction.loanBalancesFind',compact('title'));
      }

    //individual loan balances liability result
    public function LoanBalancesResult(Request $request){
        $title = 'Loan Deduction Balances';
        $loanDeductionObj = new Ldeduction;
        $this->validate(request(), [
             'to' =>'required|date',
             ]);

             $from = new Carbon('2016-02-01');
             $from = $from->toDateString();
             $to = $request['to'];

        $loanSubCollection = $loanDeductionObj->findLoanDeductionByDate($from,$to);

        $uniqueDebtors = $loanSubCollection->unique('user_id');

        return view('LoanDeduction.loanBalancesResult',compact('title','loanSubCollection','to','from','$loanDeductionObj','uniqueDebtors'));
    }

    //download in excel format individual loan Balances
    public function loanBalancesExcelExport($from,$to){
        $fileName = 'MIDAS_LOANBALANCES_'.$to.'.xlsx';
        return Excel::download(new loanBalanceExport($from,$to), $fileName);
    }

    //download in PDF format individual loan Balances
    public function loanBalancesPdf($from,$to){
        $title='Loan Deduction Balances';
        $loanDeductionObj = new Ldeduction;

        $loanDeductionCollection = $loanDeductionObj->findLoanDeductionByDate($from,$to);

        $uniqueDebtors = $loanDeductionCollection->unique('user_id');
        $pdf= PDF::loadView('Prints.loan_balances_pdf',compact('loanDeductionCollection','title','to','from','$loanDeductionObj','uniqueDebtors'));
        return $pdf->stream();
    }


///GENERAL LOAN CONSOLIDATED CODE


//form to find all user consolidated loan Balances
  public function findConsolidatedLoanBalances(){
      $title = 'Consolidated Loan Balances';
    return view('LoanDeduction.consolidatedLoanBalancesFind',compact('title'));
  }


  //consolidated  loan balances liability
  public function consolidatedLoanBalancesResult(Request $request){
      $title = 'Loan Deduction Balances';
      $consolidatedLoansObj = new Userconsolidatedloan;
      $this->validate(request(), [
           'to' =>'required|date',
           ]);

           $from = new Carbon('2016-02-01');
           $from = $from->toDateString();
           $to = $request['to'];

      $collection = $consolidatedLoansObj->consolidatedLoanDeductionByDate($from,$to);

      $uniqueDebtors = $collection->unique('user_id');

      return view('LoanDeduction.consolidatedLoanBalancesResult',compact('title','collection','to','from','uniqueDebtors'));
  }

    //download consolidated loan inputs in excel format
    public function consolidatedLoanBalancesExcelExport($from,$to){
        $fileName = 'MIDASCONSOLIDATED_LOANBALANCES_'.$to.'.xlsx';
        return Excel::download(new userConsolidatedLoanLedgerExport($from,$to), $fileName);
    }

    //download consolidated loan inputs in PDF format
    public function consolidatedLoanBalancesPdf($from,$to){
      $title="CONSOLIDATED LOAN INPUTS BALANCE";
        $consolidatedLoansObj = new Userconsolidatedloan;

        $collection = $consolidatedLoansObj->consolidatedLoanDeductionByDate($from,$to);

        $uniqueDebtors = $collection->unique('user_id');
        $pdf= PDF::loadView('Prints.allConsolidatedLoanBalancesPdf',compact('collection','title','to','from','uniqueDebtors'));
        return $pdf->stream();
    }

}
