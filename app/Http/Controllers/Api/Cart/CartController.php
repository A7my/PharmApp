<?php

namespace App\Http\Controllers\Api\Cart;

use App\Models\Cart;
use App\Helpers\helper;
use App\Models\Product;
use Nette\Utils\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function __construct(){
        $this->helper = new helper();
    }

    public function addToCart($id , Request $request){
        $newCart = new Cart;
        $newCart->user_id = Auth::user()->id;
        $newCart->product_id = $id;
        $newCart->quantity = $request->quantity;
        $newCart->total_price = $request->quantity * Product::find($id)->price;
        $newCart->save();
        return $this->helper->ResponseJson(1, __('apis.added'));
    }

    public function myCart(){
        // $myCart = Cart::where('user_id' , Auth::user()->id)->where('ordered' , 'no')->get();

        // $products = [];
        // for($i = 0; $i < $myCart->count() ; $i++){
        //     $product = Product::find($myCart[$i]->product_id);
        //     array_push($products , $product);
        // }

        // return $this->helper->ResponseJson(1, NULL , [$myCart , $myCart->count() , $products]);

        $clientId = Auth::user()->id;
        $cart = Cart::where('user_id' , $clientId)->where('ordered' , 'no')->get();
        $products = [];
        $products_images = [];
        $prices = [];
        $quantities = [];

        foreach($cart as $c){
            $product = Product::find($c->product_id);
            array_push($products , $product->name);
            array_push($products_images , $product->image);
            array_push($prices , $product->price);
            array_push($quantities , $c->quantity);
        }
        return $this->helper->ResponseJson(1, NULL , [ $products ,$products_images ,$prices , $quantities]);


    }

    public function deleteFromMyCart($id){
        $item = Cart::where('user_id' , Auth::user()->id)->where('product_id' , $id)->first();
        $recordId = $item->id;
        Cart::destroy($recordId);
        return $this->helper->ResponseJson(3, __('apis.deleted'));
    }
}
