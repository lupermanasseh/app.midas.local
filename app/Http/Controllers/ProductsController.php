<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Productdivision;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //List all products
        $title ='All Products';
        $products = Product::orderBy('status','desc')
        ->paginate(10);
        return view('Products.index',compact('products','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Form for creating a new product
        $title ='New Product'; 
        return view('Products.newProduct',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title ="New Product";
        //Save product
        $this->validate(request(), [
        'product_name' =>'required|string',
        'description'=>'required|string',
        'product_category'=>'required|integer',
        'unit_cost' =>'nullable|numeric|between:0.00,999999999.99',
        'tenor'=>'required|integer',
        'interest'=>'required|numeric|between:0.00,999999999.99',
        ]);
        
        $product = new Product();
        $product->name = $request['product_name'];
        $product->productdivision_id = $request['product_category'];
        $product->description = $request['description'];
        $product->unit_cost = $request['unit_cost'];
        $product->tenor = $request['tenor'];
        $product->interest = $request['interest'];
        $product->status = 'Active';
        $product->save();
    
        if($product->save()) {
            toastr()->success('Product has been saved successfully!');
            return redirect('/product/create');
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
        $title ='Product Detail';
        $product = Product::find($id);
        return view('Products.productDetail',compact('product','title'));
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
        $product = Product::find($id);
        return view('Products.editProducts',compact('product','title'));
        
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
        'product_name' =>'required|string',
        'description'=>'required|string',
        'product_category'=>'required|integer',
        'unit_cost' =>'nullable|numeric|between:0.00,999999999.99',
        'tenor'=>'required|integer',
        'interest'=>'required|numeric|between:0.00,999999999.99',
        ]);

        $product = Product::find($id);
        $product->name = $request['product_name'];
        $product->productdivision_id = $request['product_category'];
        $product->description = $request['description'];
        $product->unit_cost = $request['unit_cost'];
        $product->tenor = $request['tenor'];
        $product->interest = $request['interest'];
        $product->save();

        if ($product->save()) {
            toastr()->success('Product has been edited successfully!');
            return redirect('/product/detail/'.$id);
        }
    
        toastr()->error('An error has occurred trying to update product, please try again later.');
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
        $product = Product::find($id);
        $product->delete();
        if ($product->delete()) {
            toastr()->success('Data has been deleted successfully!');
            return redirect('/products');
        }
    
        toastr()->error('An error has occurred trying to discard, please try again later.');
        return back();
    }

    //Deactivate a product
    public function deactivate($id){

        $myProd = Product::find($id);
            $myProd->status = 'Inactive';
                $myProd->save();
                if($myProd->save()) {
                    toastr()->success('Product deactivated successfully');
                    return redirect('/products');
                }  
                toastr()->error('Unable to deactivate this product');
                return back();
        }

    //Activate a product
    public function activate($id){

        $myProd = Product::find($id);
            $myProd->status = 'Active';
                $myProd->save();
                if($myProd->save()) {
                    toastr()->success('Product activated successfully');
                    return redirect('/products');
                }  
                toastr()->error('Unable to activate this product');
                return back();
        }

        //Get product items based on category selection
        public function getItems($id){

                //Fetch Employees by Departmentid
                $items = Product::productItems($id);
                $output = '<option value="">Select Product'.'</option>';
                foreach($items as $item){
                    $output.='<option value="'.$item->id.'">'.$item->name.'</option>';
                }
                echo $output;
                // echo json_encode($items);
                // exit;   
        }

    
}
