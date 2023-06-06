<?php

namespace App\Http\Controllers\Api\Pharmacy;

use App\Helpers\helper;
use App\Models\Product;
use App\Models\Pharmacy;
use Nette\Utils\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PharmacyController extends Controller
{

    public function __construct(){
        $this->helper = new helper();
    }


    public function pharmacySearch(Request $request){

        $pharmacy = Pharmacy::where("name" ,"LIKE" , '%' . $request->name . '%')->get();
        return $this->helper->ResponseJson(2, NULL, [ $pharmacy ]);
    }

    public function pharmacy($id){
        $pharmacy = Pharmacy::find($id);
        return $this->helper->ResponseJson(2, NULL, [ $pharmacy ]);
    }

    public function productPharmacySearch( $id ,   Request $request){
        $product = Product::where('pharmacy_id' , $id)->where("name" ,"LIKE" , '%' . $request->name . '%' )->get();
        return $this->helper->ResponseJson(2, NULL, [ $product ]);

    }
}
