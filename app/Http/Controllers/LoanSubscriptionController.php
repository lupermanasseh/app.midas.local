<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loan;
use App\User;
use App\Product;
use App\Lsubscription;
use App\Userconsolidatedloan;
use App\Ldeduction;
use  App\Psubscription;
use  App\Saving;
use App\Targetsr;
use Carbon\Carbon;
use GuzzleHttp\Client;
use PDF;
use Illuminate\Support\Facades\DB;

class LoanSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $title ='All Loan Request';
        $loanReq = Lsubscription::withCount(['loansubscriptions' => function ($query){
            $query->where('loan_status','Pending');
        }])->paginate(5);
        return view('LoanSub.index',compact('loanReq','title'));
    }

    //form  to find loan disbursements by date

      public function loanDisbursementFind(){
          $title = 'Find Loans';
        return view('LoanSub.loanDisbursementDateFind',compact('title'));
      }

      //loan disbursements result
      public function loanDisbursementByDateResult(Request $request){
          $title = 'Loan Disbursement By Date';

          $this->validate(request(), [
               'disbursement_date' =>'nullable|date',
               ]);

               //$from = new Carbon('2016-02-01');
               //$from = $from->toDateString();
               $date = $request['disbursement_date'];
               $newLoanSub = new Lsubscription();

          $loanByDate = $newLoanSub->findLoansByDisbursementDate($date);

          return view('LoanSub.loanByDisbursementResult',compact('title','loanByDate'));
      }

      //edit loan disbursement date
      public function editDisbursementDate(Request $request)
          {
          //
          $this->validate(request(), [
              'disbursement_date'=>'required|date',
              'sub_id'=>'required|integer',
              ]);


              $subid = $request['sub_id'];
              $disbursement_date = $request['disbursement_date'];

              $loan_sub = Lsubscription::find($subid);

              $loan_sub->disbursement_date = $disbursement_date;

                  $loan_sub->save();
                  if($loan_sub->save()) {
                      toastr()->success('Disbursement Date Saved Successfully!');
                      return redirect('/loandisbursement/date');
                  }
                  toastr()->error('An error has occurred trying to update record!');
                  return back();
          }


//loan disbursement by date
//this method is used to return the user to the same page
public function loanDisbursementSingleDate(){
    $title = 'Loan Disbursement By Date';
$date = null;

 $loanByDate = Lsubscription::where('disbursement_date', $date)
                             ->get();;

  return view('LoanSub.loanByDisbursementResult',compact('title','loanByDate'));
}

    /**
     * Payment schedule
     */

    public function loanSchedule($id){
        $title = 'Loan Payment Schedule';
        $loan = Lsubscription::find($id);
        return view('LoanSub.schedule',compact('title','loan'));
    }

    //print loan Schedule to file
    public function loanSchedulePrint($id){
        $title = 'Loan Payment Schedule';
        $loan = Lsubscription::find($id);
        $userObj = User::find($loan->user_id);
        return view('Prints.loan_schedule_print',compact('title','loan','userObj'));
    }

    //print loan schedule to pdf
    public function loanSchedulePdf($id){
        $title = 'Loan Payment Schedule';
        $loan = Lsubscription::find($id);
        $userObj = User::find($loan->user_id);

        $pdf = PDF::loadView('Prints.loan_schedule_pdf',compact('loan','title','userObj'));
        return $pdf->stream();
        // return $pdf->download('statementOfSavings.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //New Loan Subscription Form
        $title ='New Loan Subscription';
        return view('LoanSub.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
        {
        //
        $this->validate(request(), [
            'reg_no'=>'required|integer',
            //'product_cat'=>'required|integer',
            'product_item'=>'required|integer',
            'custom_tenor' =>'nullable|integer|between:1,60',
            'guarantor_id1' => 'nullable|integer',
            'guarantor_id2' => 'nullable|integer',
            'units' => 'nullable|integer',
            'amount_applied' =>'required|numeric|between:0.00,999999999.99',
            'net_pay' =>'required|numeric|between:0.00,999999999.99',
            ]);



                $loan_sub = new Lsubscription();
                $product = Product::find($request['product_item']);

                //check fo active users
                // $guarantor1 = User::find(request(['guarantor_id1']));
                // $guarantor2 = User::find(request(['guarantor_id2']));
                // $applicant = User::find(request(['reg_no']));
                // if($guarantor1=="" || $guarantor2=="" || $applicant==""){
                //     toastr()->error('One or more users do not exist');
                //     return redirect('/loanSub/create');
                // }
                //Check loan eleigibility by total indebtedness
                $user = new User();
                $totalIndebtedness = $user->totalApprovedAmount($request['reg_no']);
                if($totalIndebtedness >=5000000){
                    //$allowed = 5000000-$totalIndebtedness;
                    toastr()->error('Maximum loan amount of N 5,000,000 exceeded');
                    return redirect('/loanSub/create');
                }

                $amtApplied = $request['amount_applied'];

                if($request['custom_tenor']){
                    $tenor = $request['custom_tenor'];
                }else{
                    $tenor = $product->tenor;
                }

                if($amtApplied){
                    $amtApplied = $amtApplied;
                }else{
                    $amtApplied = $product->unit_cost * $request['units'];
                }

                //$loan_sub->productdivision_id = $request['product_cat'];
                $loan_sub->product_id = $request['product_item'];
                $loan_sub->user_id = $request['reg_no'];
                $loan_sub->guarantor_id1 = $request['guarantor_id1'];
                $loan_sub->guarantor_id2 = $request['guarantor_id2'];
                $loan_sub->monthly_deduction = $amtApplied/$tenor;
                $loan_sub->custom_tenor = $tenor;
                $loan_sub->amount_applied = $amtApplied;
                $loan_sub->units = $request['units'];
                $loan_sub->net_pay = $request['net_pay'];
                $loan_sub->created_by = auth()->user()->first_name;
                $loan_sub->save();
                if($loan_sub->save()) {
                    toastr()->success('Loan request has been saved successfully!');
                    return redirect('/loanSub/create');
                }
                toastr()->error('An error has occurred trying to create a loan request!');
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
        //Show detail of all subscriptions for a particular product

        $title ='Loan Subscriptions Detail';
        $loanDetails = Lsubscription::where('loan_id',$id)
        ->where(function($query){
            $query->where('loan_status','Pending');
        })->with(['product' => function ($query) {
          $query->orderBy('name', 'desc');
      }])->paginate(10);

        return view('LoanSub.loanSubDetail',compact('loanDetails','title'));
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
        {
        // Show form for editing loan subscription
        $title ='Edit Loan Subscription';
        $user = new User;
        $lSub = Lsubscription::find($id);
        $g1 = $lSub->guarantor_id;
        $g2 = $lSub->guarantor_id2;
        $applicant_reg = $lSub->user_id;
        return view('LoanSub.editLoanSub',compact('lSub','title','g1','g2','applicant_reg'));
        }


//edit existing loan
public function paidLoanEdit($id)
    {
    // Show form for editing loan subscription
    $title ='Edit Existing Loan';

    $lSub = Lsubscription::find($id);

    return view('LoanSub.paidLoanEdit',compact('lSub','title'));
    }

    //update existing paid loan
    public function updatePaidLoan(Request $request, $id)
        {
        //
        $this->validate(request(), [

            'tenor' =>'required|integer|between:1,60',
            'loan_amount' =>'required|numeric|between:0.00,999999999.99',
            'deduction' =>'required|numeric|between:0.00,999999999.99',
            'start_date' =>'required|date',
            'end_date' =>'required|date',
            'disbursement_date' =>'nullable|date',

            ]);


            DB::beginTransaction();
            try{
              $loan_sub = Lsubscription::find($id);

              //Check loan eleigibility by total indebtedness
              $user = new User();
              $totalIndebtedness = $user->totalApprovedAmount($request['reg_no']);
              if($totalIndebtedness >=5000000){
                  //$allowed = 5000000-$totalIndebtedness;
                  toastr()->error('Maximum loan amount of N 5,000,000 exceeded');
                  return back();
                  //return redirect('/loanSub/create');
              }

              $loanAmt = $request['loan_amount'];
              $tenor = $request['tenor'];
              $deduction = $request['deduction'];
              $start_date = $request['start_date'];
              $end_date = $request['end_date'];
              $disbursement_date = $request['disbursement_date'];

              $loan_sub->monthly_deduction = $deduction;
              $loan_sub->custom_tenor = $tenor;
              $loan_sub->amount_approved = $loanAmt;
              $loan_sub->loan_start_date = $start_date;
              $loan_sub->loan_end_date = $end_date;
              $loan_sub->disbursement_date = $disbursement_date;
              $loan_sub->save();

            }
            catch(\Exception $e){
              DB::rollback();
              toastr()->error($e->getMessage());
              return back();
            }
            DB::commit();
            toastr()->success('Record updated successfully!');
            return redirect('/loanDeduction/history/'.$loan_sub->id);
        }

///Deactivate loan

public function deactivateLoan($id)
    {

        DB::beginTransaction();
        try{
          $loan_sub = Lsubscription::find($id);

          $loan_sub->loan_status = "Inactive";
          $loan_sub->save();

        }
        catch(\Exception $e){
          DB::rollback();
          toastr()->error($e->getMessage());
          return back();
        }
        DB::commit();
        toastr()->success('Record updated successfully!');
        return redirect('/user/landingPage/'.$loan_sub->user_id);
    }


    ///Activate loan

    public function activateLoan($id)
        {

            DB::beginTransaction();
            try{
              $loan_sub = Lsubscription::find($id);

              $loan_sub->loan_status = "Active";
              $loan_sub->save();

            }
            catch(\Exception $e){
              DB::rollback();
              toastr()->error($e->getMessage());
              return back();
            }
            DB::commit();
            toastr()->success('Record updated successfully!');
            return redirect('/user/landingPage/'.$loan_sub->user_id);
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
            'reg_no'=>'required|integer',
            //'product_cat'=>'required|integer',
            'product_item'=>'required|integer',
            'custom_tenor' =>'nullable|integer|between:1,60',
            'guarantor_id1' => 'required|integer',
            'guarantor_id2' => 'required|integer',
            'units' => 'nullable|integer',
            'amount_applied' =>'nullable|numeric|between:0.00,999999999.99',
            'net_pay' =>'required|numeric|between:0.00,999999999.99',
            ]);



                $loan_sub = Lsubscription::find($id);
                $product = Product::find($request['product_item']);

                //check fo active users
                $guarantor1 = User::find(request(['guarantor_id1']));
                $guarantor2 = User::find(request(['guarantor_id2']));
                $applicant = User::find(request(['reg_no']));
                if($guarantor1=="" || $guarantor2=="" || $applicant==""){
                    toastr()->error('One or more users do not exist');
                    return redirect('/loanSub/create');
                }
                //Check loan eleigibility by total indebtedness
                $user = new User();
                $totalIndebtedness = $user->totalApprovedAmount($request['reg_no']);
                if($totalIndebtedness >=5000000){
                    //$allowed = 5000000-$totalIndebtedness;
                    toastr()->error('Maximum loan amount of N 5,000,000 exceeded');
                    return redirect('/loanSub/create');
                }

                $amtApplied = $request['amount_applied'];

                if($request['custom_tenor']){
                    $tenor = $request['custom_tenor'];
                }else{
                    $tenor = $product->tenor;
                }

                if($amtApplied){
                    $amtApplied = $amtApplied;
                }else{
                    $amtApplied = $product->unit_cost * $request['units'];
                }

                //$loan_sub->productdivision_id = $request['product_cat'];
                $loan_sub->product_id = $request['product_item'];
                $loan_sub->user_id = $request['reg_no'];
                $loan_sub->guarantor_id = $request['guarantor_id1'];
                $loan_sub->guarantor_id2 = $request['guarantor_id2'];
                $loan_sub->monthly_deduction = $amtApplied/$tenor;
                $loan_sub->custom_tenor = $tenor;
                $loan_sub->amount_applied = $amtApplied;
                $loan_sub->units = $request['units'];
                $loan_sub->net_pay = $request['net_pay'];
                $loan_sub->created_by = auth()->user()->first_name;
                $loan_sub->save();
                if($loan_sub->save()) {
                    toastr()->success('Loan request has been updated successfully!');
                    return redirect('/loanSub/create');
                }
                toastr()->error('An error has occurred trying to update a loan request!');
                return back();
        }


//USER SUBSCRIPTION DETAILS PAGE
    public function userLoanSubscriptions($id){
        $title = "User Page";

        $saving = new Saving;
        //Find user
        $user = User::find($id);

        //Active Product Subscriptions
        $activeLoans = Lsubscription::activeLoans($id);

        //Pending product subscriptions
        $pendingLoans = Lsubscription::pendingLoans($id);

        //User target saving subscriptions
        //$targetsr = Targetsr::where('user_id',$id)
                           // ->get();

        //User pending products subscriptions
        //$userPendingProducts = Psubscription::pendingProducts($id);

        return view('LoanSub.userLoanSub',compact('title','activeLoans','pendingLoans','user','saving'));
    }

//guarantor dashboard
public function guarantorDashboard(){
    $title ='Loan Guarantors';
    $newSubObj = new Lsubscription;
    $review = Lsubscription::find(8);
    $uniqueGuarantors = $newSubObj->uniqueGuarantors()->sort();
    return view('LoanSub.guarantors',compact('uniqueGuarantors','title','review'));
}

//guarantor details page
public function guarantorDetails($id){
    $title ='Guarantor Details';
    $newUser = User::find($id);
    $newSubObj = new Lsubscription;
    $firstGuarantor = Lsubscription::guarantorAsFirst($id);
    $secondGuarantor = Lsubscription::guarantorAsSecond($id);
    return view('LoanSub.guarantorDetails',compact('firstGuarantor','secondGuarantor','title','newUser','newSubObj'));
}

    //show form for reviewing user loan
    public function review($id){
        $title ='Review Loan Subscription';
        $review = Lsubscription::find($id);
        return view('LoanSub.review',compact('review','title'));
    }

    //Review Store
    public function reviewStore(Request $request, $id)
        {
        //

            $this->validate(request(), [
            'notes' =>'required|string',
            'review_date' =>'required|date',
            'amount_approved' =>'required|numeric|between:0.00,999999999.99',
            ]);


                 //Retrieve loan subscription instance
                $loan_sub = Lsubscription::find($id);

                $tenor = $loan_sub->custom_tenor;

                $approved_amt = $request['amount_approved'];
                $notes = $request['notes'];

                $rev_date = new Carbon($request['review_date']);
                $loan_sub->amount_approved = $approved_amt;
                $loan_sub->loan_status = 'Reviewed';
                $loan_sub->review_date =$rev_date;
                $loan_sub->monthly_deduction =$approved_amt/$tenor;
                $loan_sub->review_comment = $notes;
                $loan_sub->review_by = auth()->user()->first_name;
                $loan_sub->save();
                if($loan_sub->save()) {
                    toastr()->success('Loan request has been reviewed successfully!');
                    //redirect user loans listing page
                    return redirect('/pendingLoans');
                }
                toastr()->error('An error has occurred trying to review a loan request!');
                return back();
        }


        //All pending loans
        public function pendingLoans(){
        $title ='All Pending Loans';
        $pendingLoans = Lsubscription::where('loan_status','Pending')
                                    ->oldest()->with(['product','user'])
                                    ->paginate(20);
        return view('LoanSub.pendingLoans',compact('pendingLoans','title'));
        }

        //All active Loans

        public function activeLoans(){
            $title ='All Active Loans';
            $activeLoans = Lsubscription::where('loan_status','Active')
            ->orderBy('user_id','asc')
            ->with(['user'])
            ->paginate(100);
            return view('LoanSub.activeLoans',compact('activeLoans','title'));
            }


//All loan subscriptions by a users
public function allLoansByUser($id){
    $title ='My Loans';

    $allLoans = Lsubscription::allLoans($id);
    return view('LoanSub.allUserLoans',compact('allLoans','title','id'));

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
        //
        DB::beginTransaction();
        try{
          //remove loan subscription
          $loanSubscription = Lsubscription::find($id)->delete();
        }
        catch(\Exception $e){
          DB::rollback();
          toastr()->error($e->getMessage());
          return back();
        }
        DB::commit();
        toastr()->success('Loan subscription removed successfully!');
        return redirect('/pendingLoans');

    }


//destroy loan deductions
public function destroyLoanDeductions($id)
{
    //
    //
    DB::beginTransaction();
    try{
      //remove loan subscription
      $loanSubscription = Lsubscription::find($id);
      $loanSubscription->delete();

      //find corresponding loan deductions
      $loanDeductions = Ldeduction::where('lsubscription_id',$id)
                                  ->delete();
    }
    catch(\Exception $e){
      DB::rollback();
      toastr()->error($e->getMessage());
      return back();
    }
    DB::commit();
    toastr()->success('Record(s) removed successfully!');
    return redirect('/user/landingPage/'.$loanSubscription->user_id);
}

    //Stop Loan
    public function loanStop($id){

        $loanSub = Lsubscription::find($id);

        $loanAmount = $loanSub->amount_approved;
        //3 get sum deductions for the product
        $totalDeductions = $loanSub->totalLoanDeductions($id);
        //find the diff
        $diffRslt = $loanAmount-$totalDeductions;
        if($diffRslt <= 0){
            //update the subj obj status to inactive
            //return to active Sub page
            $loanSub->status = 'Inactive';
            $loanSub->loan_end_date = now()->toDateString();
            //$loanSub->review_by = auth()->id();
                $loanSub->save();
                if($loanSub->save()) {
                    toastr()->success('This loan subscription has been successfully stopped');
                    return redirect('/user/page/'.$loanSub->user_id);
                }
        }
                toastr()->error('You can not stop this facility, please check details');
                return back();

    }

            //Loan Details
            public function loanDetails($id){
            $title = 'User Loan Details';
            //find the loan subscription details
            $userLoan = Lsubscription::find($id);
            return view('LoanSub.activeLoanDetails',compact('userLoan','title'));
        }

        //pending app detail
        public function pendingAppDetail($id){
            $title = 'Pending Application Details';
            //find the loan subscription details
            $userLoan = Lsubscription::find($id);
            return view('LoanSub.pendingAppDetail',compact('userLoan','title'));
        }
        //all audited loans
         public function auditedLoans(){
            $title ='All Audited Loans';
            $auditedLoans = Lsubscription::where('loan_status','Reviewed')
                                            ->oldest()->with(['product','user'])
                                            ->paginate(20);
            return view('LoanSub.auditedLoans',compact('auditedLoans','title'));
            }

            //All approved loans
            public function readyLoans(){
                $title ='All Aprroved Loans';
                $approvedLoans = Lsubscription::where('loan_status','Approved')
                                                ->oldest()->with(['product','user'])
                                                ->paginate(20);
                return view('LoanSub.approvedLoans',compact('approvedLoans','title'));
                }

            //Approve Loans
            public function approveLoan($id){

                    $userLoan = Lsubscription::find($id);

                    // $approved_amt = number_format($userLoan->amount_approved,2,'.',',');
                    // $product = $userLoan->product->name;
                    // $phone = $userLoan->user->phone;

                    $userLoan->loan_status ="Approved";
                    $userLoan->approved_date= now()->toDateString();
                    $userLoan->approve_by = auth()->user()->first_name;
                    $userLoan->save();
                    //send message of approval
                    // if($userLoan->save()){
                    //     //send message
                    //     $client = new Client;
                    //     $api = '9IGspBnLAjWENmr9nPogQRN9PuVwAHsSPtGi5szTdBfVmC2leqAe8vsZh6dg';
                    //     $to = $phone;
                    //     $from= 'MIDAS';
                    //     $message = 'Your loan has been approved N'.$approved_amt;
                    //    $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create?api_token='.$api.'&from='.$from.'&to='.$to.'&body='.$message.'&dnd=1';

                    //    $response = $client->request('GET', $url,['verify'=>false]);
                    // //    if($response->getStatusCode()==200){
                    // //        //redirect here
                    // //    }
                    // }else{
                    //     toastr()->error('Unable to approve loan! try again');
                    //     return back();
                    // }

                }

                //Pay loan form
                public function payLoan($id){
                    $title ='Pay Loans';
                    $review = Lsubscription::find($id);
                    return view('LoanSub.payLoans',compact('review','title'));
                }

                // store activate loan
                public function payStore(Request $request){
                    $this->validate(request(), [
                        'start_date' =>'required|date',
                        'disbursement_date' =>'required|date',
                        'sub_id' =>'required|integer',
                        ]);

                        //begin transaction to process loan topup
                        DB::beginTransaction();
                        try{
                          $loan_id = $request['sub_id'];
                          $dt = $request['start_date'];
                          $date = new Carbon($dt);
                          $start_date = $date->toDateString();
                          //Retrieve loan subscription instance
                          $loan_sub = Lsubscription::find($loan_id);
                          $tenor = $loan_sub->custom_tenor;
                          $amt_approved = number_format($loan_sub->amount_approved,2,'.',',');
                          $product = $loan_sub->product->name;
                          $phone = $loan_sub->user->phone;
                          $end_Date = $loan_sub->SubEndDate($start_date,$tenor);
                          //update loan
                          $loan_sub->loan_start_date = $start_date;
                          $loan_sub->loan_end_date = $end_Date;
                          $loan_sub->disbursement_date = $request['disbursement_date'];
                          $loan_sub->loan_status = 'Active';
                          $loan_sub->save();

                            //send message
                             //  $client = new Client;
                             //  $api = '9IGspBnLAjWENmr9nPogQRN9PuVwAHsSPtGi5szTdBfVmC2leqAe8vsZh6dg';
                             //  $to = $phone;
                             //  $from= 'MIDAS TOUCH';
                             //  $message = 'Your '.$product.' facility of N'. $amt_approved.' has been paid and is now active. Thank you. MIDAS TEAM';
                             // $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create?api_token='.$api.'&from='.$from.'&to='.$to.'&body='.$message.'&dnd=1';
                             //
                             // $response = $client->request('GET', $url,['verify'=>false]);

                             //post amount to user consolidated loans
                             $newConsolidatedDeduct = new Userconsolidatedloan();

                             $now = Carbon::now()->toTimeString();
                             $newConsolidatedDeduct->user_id = $loan_sub->user_id;
                             $newConsolidatedDeduct->description = 'Normal loan disbursement';
                             $newConsolidatedDeduct->date_entry = $request['disbursement_date'];
                             $newConsolidatedDeduct->entry_time = $now;
                             $newConsolidatedDeduct->debit = $loan_sub->amount_approved;
                             $newConsolidatedDeduct->save();
                             $newConsolidatedDeduct->userConsolidatedBalances($loan_sub->user_id);
                        }
                        catch(\Exception $e){
                        DB::rollback();
                        toastr()->error($e->getMessage());
                        return back();
                        }
                        DB::commit();
                        toastr()->success('Loan activated successfully!');
                        return redirect('/approved/loans');



                }
}
