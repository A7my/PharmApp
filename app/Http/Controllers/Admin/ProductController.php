<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function products(){
        $products = Product::get();
        return view('admin.productsSetting.showProducts' , compact('products'));
    }
    public function createProduct(){
        return view('admin.productsSetting.createProduct');

    }
    public function storeProduct(Request $request){
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required',
            'pharmacy' => 'required',
            'quantity' => 'required'
        ]);



        if(isset($request->image)){
            $imageName  = $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('image/product'), $imageName);


            $newProduct = new Product;
            $newProduct->name = $request->name;
            $newProduct->description = $request->description;
            $newProduct->price = $request->price;
            $newProduct->category_id = $request->category;
            $newProduct->pharmacy_id = $request->pharmacy;
            $newProduct->image = $imageName;
            $newProduct->quantity = $request->quantity;
            $newProduct->save();
        }

        return redirect('products')->with('createProduct' , 'You created product successfully');
    }

    public function editProduct($id){
        $product = Product::find($id);
        return view('admin.productsSetting.editProduct' , compact('product'));
    }
    public function updateProduct($id , Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        if(isset($request->image)){
            $imageName  = $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('image/product'), $imageName);

            $product = Product::find($id);
            $product->image = $imageName;
            $product->save();
        }

            $product = Product::find($id);
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->save();

            return redirect('products')->with('successEditProduct' , 'You have updated productd successfully');
    }

    public function deleteProduct($id){
        $deleteProduct = Product::destroy($id);
        return redirect('products')->with('deleteProduct' , 'you have deleted a product');
    }
}
