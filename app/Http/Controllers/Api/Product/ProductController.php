<?php

namespace App\Http\Controllers\Api\Product;

use App\Helpers\helper;
use App\Models\Product;
use App\Models\Pharmacy;
use Nette\Utils\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function __construct(){
        $this->helper = new helper();
    }


    public function product($id){
        $product = Product::find($id);
        $pharmacyName = Pharmacy::find($product->pharmacy_id)->name;
        $pharmacyAddress = Pharmacy::find($product->pharmacy_id)->address;
        $pharmacyPhone = Pharmacy::find($product->pharmacy_id)->phone_number;
        return $this->helper->ResponseJson(1, NULL , [$product  , $pharmacyName , $pharmacyAddress , $pharmacyPhone]);

    }

    public function searchProduct(Request $request){

        $product = Product::where("name" ,"LIKE" , '%' . $request->name . '%')->first();
        $pharmcay = Pharmacy::find($product->pharmacy_id);

        return $this->helper->ResponseJson(2 , NULL, [$product , $pharmcay]);
    }
}
