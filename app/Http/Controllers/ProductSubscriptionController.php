<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\Psubscription;
use Carbon\Carbon;
use App\Productdivision;

class ProductSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //List all Subscriptions
        $title ='All Product Subscriptions';

        $prod = Product::withCount(['psubscriptions' => function ($query){
            $query->where('status','Pending');
        }])->paginate(5);
        return view('ProductSub.index',compact('prod','title'));
        // $users = DB::table('users')
        //              ->select(DB::raw('count(*) as user_count, status'))
        //              ->where('status', '<>', 1)
        //              ->groupBy('status')
        //              ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //New Subscription from
        $title ='New Product Subscription';
        $category = Productdivision::orderBy('name')->get();
        return view('ProductSub.create',compact('title','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //Save product subscription
            $this->validate(request(), [
                'product' =>'required|integer',
                'payment_id'=>'required|integer',
                'units' => 'required|integer|between:1,60',
                // 'guarantor_id' => 'required|integer',
                'net_pay' =>'required|numeric|between:0.00,999999999.99',
                ]);
    
                if(User::where('payment_number',request(['payment_id']))->exists())
                {
                    $user = User::where('payment_number',request(['payment_id']))->first();
                    $user_id = $user->id;
                    $product = Product::find($request['product']);
                    //Total subscription cost
                    $productSubTotalCost = Psubscription::totalProductCost($product->unit_cost, $request['units']);
                    $productTenor = $product->tenor;
                    $product_sub = new Psubscription();
                    $product_sub->user_id = $user_id;
                    $product_sub->product_id = $request['product'];
                    $product_sub->monthly_repayment = $productSubTotalCost/$productTenor;
                    $product_sub->total_amount = $productSubTotalCost;
                    //$product_sub->guarantor_id = User::userID(request(['guarantor_id']));
                    $product_sub->units = $request['units'];
                    $product_sub->net_pay = $request['net_pay'];
                    $product_sub->staff_id = auth()->id();
                    $product_sub->save();
                    if($product_sub->save()) {
                        toastr()->success('Product Subscription has been saved successfully!');
                        return redirect('/subscriptions');
                    }
                    toastr()->error('An error has occurred trying to create a subscription.');
                    return back();
                }
            toastr()->error('No user exist with this payment identification number.');
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
          //Display detail product subscription listings
          $title ='Product Subscriptions';

          $subs = Psubscription::where('product_id',$id)
          ->with(['product' => function ($query) {
            $query->orderBy('status', 'asc');
        }])->paginate(50);
          
          return view('ProductSub.subscriptionDetails',compact('subs','title'));
    }


    //Show individual user subscriptions
    public function userSubscriptions($id){
        $title = "User Subscriptions";
        $userProducts = Psubscription::userProducts($id);
        return view('ProductSub.userProducts',compact('userProducts','title'));
    }

    //Item Details, pass in subscription ID
    public function itemDetails($id){
        $title = "Item Detail";
        $itemDetail = Psubscription::itemDetails($id);
        return view('ProductSub.itemDetail',compact('itemDetail','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * Show the form for editing a subscription
     */
    public function edit($id)
    {
        //
        $title ='Edit Product Subscription';
        $product = Psubscription::find($id);
        return view('ProductSub.editSubscription',compact('product','title'));
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
        
        //Save product subscription
        $this->validate(request(), [
            'product' =>'required|integer',
            'payment_id'=>'required|integer',
            'units' => 'required|integer|between:1,60',
            //'guarantor_id' => 'required|integer',
            'net_pay' =>'required|numeric|between:0.00,999999999.99',
            ]);

            if(User::where('payment_number',request(['payment_id']))->exists())
            {
                $user = User::where('payment_number',request(['payment_id']))->first();
                $user_id = $user->id;
                $product = Product::find($request['product']);
                //Total subscription cost
                $productSubTotalCost = Psubscription::totalProductCost($product->unit_cost, $request['units']);
                $productTenor = $product->tenor;
                $product_sub = Psubscription::find($id);
                $product_sub->user_id = $user_id;
                $product_sub->product_id = $request['product'];
                $product_sub->monthly_repayment = $productSubTotalCost/$productTenor;
                $product_sub->total_amount = $productSubTotalCost;
                //$product_sub->guarantor_id = User::userID(request(['guarantor_id']));
                $product_sub->units = $request['units'];
                $product_sub->net_pay = $request['net_pay'];
                $product_sub->staff_id = auth()->id();
                $product_sub->save();
                if($product_sub->save()) {
                    toastr()->success('Product Subscription updated successfully!');
                    return redirect('/prodSub/pending');
                }
            
                toastr()->error('An error has occurred trying to update user subscription.');
                return back();
            }
        toastr()->error('No user exist with this payment identification number.');
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
        //Delete Product Subscription
        $dlt = Psubscription::find($id)->delete();
        if($dlt) {
            toastr()->success('Product subscription deleted successfully!');
            return redirect('/prodSub/pending');
        }
    
        toastr()->error('An error has occurred trying to delete user subscription.');
        return back();
    }

    
      //All pending subscriptions
      public function pendingSubscriptions(){
        $title ='All Pending Subscriptions';
        $pendingSubs = Psubscription::pendingSubs();
        return view('ProductSub.pending',compact('pendingSubs','title'));
        }

        //All active subscriptions

        public function activeSubscriptions(){
            $title ='All Active Subscriptions';
            $activeSubs = Psubscription::activeSubs();
            return view('ProductSub.active',compact('activeSubs','title'));
            }

        //stop subscription
        public function subStop($id){

            $mySub = Psubscription::find($id);
            
            $sumOfProduct = $mySub->total_amount;
            //3 get sum deductions for the product
            $totalDeductions = $mySub->totalSubDeductions($id);
            //find the diff
            $diffRslt = $sumOfProduct-$totalDeductions;
            if($diffRslt <= 0){
                //update the subj obj status to inactive
                //retrun to active Sub page
                $mySub->status = 'Inactive';
                $mySub->end_date = now()->toDateString();
                $mySub->review_by = auth()->id();
                    $mySub->save();
                    if($mySub->save()) {
                        toastr()->success('This subscription has been successfully stop');
                        return redirect('/user/page/'.$mySub->user_id);
                    }
            }
            toastr()->error('You can not stop this facility, please check details');
                    return back();

            }

            //Review product subscription
            public function review($id){
            $title ='Review Loan Subscription';
            $review = Psubscription::find($id);
            return view('ProductSub.reviewProdSub',compact('review','title'));
            }

//Store Product Review
public function reviewStore(Request $request, $id){
     //Save product subscription
     $this->validate(request(), [
         'start_date' => 'required|date',
         'end_date' => 'required|date',
        'units' => 'required|integer|between:1,60',
        'notes' =>'required|string',
        ]);

            $product_sub = Psubscription::find($id);
            $product_tenor = $product_sub->product->tenor;
            $product_unitCost = $product_sub->product->unit_cost;
            //Total subscription cost
            $productSubTotalCost = Psubscription::totalProductCost($product_unitCost, $request['units']);
           
            $product_sub->monthly_repayment = $productSubTotalCost/$product_tenor;
            $product_sub->total_amount = $productSubTotalCost;
            $product_sub->units = $request['units'];
            $product_sub->start_date = $request['start_date'];
            $product_sub->end_date = $request['end_date'];
            $product_sub->status = 'Active';
            $product_sub->review_comment = $request['notes'];
            $product_sub->staff_id = auth()->id();
            $product_sub->save();
            if($product_sub->save()) {
                toastr()->success('Product Subscription has been reviewed successfully!');
                return redirect('/prodSub/pending');
            }
            toastr()->error('An error has occurred trying to review a subscription.');
            return back();
   
}

    


}
