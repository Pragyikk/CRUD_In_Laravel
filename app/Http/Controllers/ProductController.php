<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products= Product::orderBy('created_at','desc')->get();
        return view('products.index',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),[ //::make creates a new validator instance
            'name'=>'required',
            'sku'=>'required|unique:products,sku', //products table an sku column's sku must be unique
            'price'=>'required|numeric',
            'status'=>'required',
            'image'=>'image|mimes:jpeg,png.jpg',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();//back ()to prev page withInput() use filled ip
        }

        $product= new Product(); //obj of product class created
        $product->name=$request->name;
        $product->sku=$request->sku;
        $product->price=$request->price;
        $product->status=$request->status;
        $product->save();
        //session()->flash('success','Product created successfully.') //either thisor below one

        if($request->hasFile('image')){
            $image= $request->image;
            $imageName= time().'.'.$image->getClientOriginalExtension(); //20210539.jpg
            $image->move(public_path('uploads/products'),$imageName); //stores it in public/uploads/products
            $product->image= $imageName;
            $product->save(); //now it updates
        }
        return redirect(route('products.index'))->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product= Product::findOrFail($id); //product exists in database or

        return view('products.edit',['product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $product= Product::findOrFail($id);
        $oldImage= $product->image;

         $validator= Validator::make($request->all(),[ //::make creates a new validator instance
            'name'=>'required',
            'sku'=>'required|unique:products,sku,' .$id, //excludes checking this particular id while updating
            'price'=>'required|numeric',
            'status'=>'required',
            'image'=>'image|mimes:jpeg,png.jpg',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();//back ()to prev page withInput() use filled ip
        }

        // $product= new Product(); //don't need this as object has been created from above
        $product->name=$request->name;
        $product->sku=$request->sku;
        $product->price=$request->price;
        $product->status=$request->status;
        $product->save();
        //session()->flash('success','Product created successfully.') //either thisor below one

        if($request->hasFile('image')){

            if($oldImage!=null && File::exists(public_path('uploads/products/' .$oldImage))){
                File::delete(public_path('uploads/products/') .$oldImage);
            }

            $image= $request->image;
            $imageName= time().'.'.$image->getClientOriginalExtension(); //20210539.jpg
            $image->move(public_path('uploads/products'),$imageName); //stores it in public/uploads/products
            $product->image= $imageName;
            $product->save(); //now it updates
        }
        return redirect(route('products.index'))->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product= Product::findOrFail($id);

        if($product->image !=null && File::exists(public_path('uploads/products/' .$product->image))){
            File::delete(public_path('uploads/products/' .$product->image));
        }

        $product->delete();

        return redirect(route('products.index'))->with('success', 'Product deleted successfully');
    }
}
