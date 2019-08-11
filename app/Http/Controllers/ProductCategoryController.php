<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productdivision;
use App\Product;

class ProductCategoryController extends Controller
{
    /**
     * Display all categories
     */
    public function index(){
        $title ="All Product Categories";
        $categories = Productdivision::all();
        return view('ProductCategory.index',compact('categories','title'));
    }


    /**
     * Show create category form
     */
    public function create(){
        $title ="New Product Category";
        return view('ProductCategory.create',compact('title'));
    }

    /**
     * Store a category
     */
    public function store(Request $request){
        
        $this->validate(request(), [
        'category_name' =>'required|string',
        'description'=>'required|string',
        ]);
        
        $productCategory = new Productdivision();
        $productCategory->name = $request['category_name'];
        $productCategory->description = $request['description'];
        $productCategory->save();
    
        if($productCategory->save()) {
            toastr()->success('Product category has been created successfully!');
            return redirect('/product/category/add');
        }
    
        toastr()->error('An error has occurred trying to save, please try again later.');
        return back();
    }
 
    /**
     * Edit product category
     * @param int $id
     */

    public function edit($id){
        $title = "Edit Product Category";
        $category = Productdivision::find($id);
        return view('ProductCategory.edit',compact('category','title')); 
    }


    /**
     * Update category
     * @param int $id
     */
    public function update(Request $request, $id){
        $this->validate(request(), [
            'catgeory_name' =>'required|string',
            'description'=>'required|string',
            ]);
            
            $productCategory = Productdivision::find($id);
            $productCategory->name = $request['category_name'];
            $productCategory->description = $request['description'];
            $productCategory->save();
        
            if($productCategory->save()) {
                toastr()->success('Product category has been edited successfully!');
                return redirect('/product/category');
            }
        
            toastr()->error('An error has occurred trying to edit, please try again later.');
            return back();
    }

    /**
     * Find product catgeory items
     * @param int $id
     */
    public function categoryItems($id){
        $title = 'Category Items';
        $categoryItems = $this->productItems($id);
        return view('ProductCategory.categoryItems',compact('title','categoryItems'));

    }

    /**
     * find all product items belonging to a product category
     * @param int $categoryid
     */
    function productItems($categoryid){
        return Product::where('productdivision_id',$categoryid)
                        ->with('productcategory')
                                ->get();
    }
}
