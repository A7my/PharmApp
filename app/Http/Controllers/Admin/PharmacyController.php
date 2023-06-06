<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pharmacy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PharmacyController extends Controller
{

    public function showPharms(){
        $pharms = Pharmacy::get();
        return view('admin.pharmaciesSetting.showPharms' , compact('pharms'));
    }

    public function createPharmacy(){
        return view('admin.pharmaciesSetting.createPharm');
    }

    public function storePharmacy(Request $request){

        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'phone_number' => 'required|unique:pharmacies,phone_number',
            'address' => 'required',
            'delivery' => 'required'
        ]);

        if(isset($request->image)){
            $imageName  = $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('image/pharmacy'), $imageName);

            $pharm = new Pharmacy;
            $pharm->name = $request->name;
            $pharm->image = $imageName;
            $pharm->address = $request->address;
            $pharm->delivery = $request->delivery;
            $pharm->phone_number = $request->phone_number;
            $pharm->save();
        }

        return redirect('pharmacies')->with('addedPharm' , 'you added a new pharmacy successfully');
    }

    public function editPharmacy($id){
        $pharm = Pharmacy::find($id);
        return view('admin.pharmaciesSetting.editPharm' , compact('pharm'));
    }

    public function updatePharmacy(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'delivery' => 'required'
        ]);

        if(isset($request->image)){
            $imageName  = $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('image/pharmacy'), $imageName);

            $category = Pharmacy::find($id);
            $category->image = $imageName;
            $category->save();
        }

        $category = Pharmacy::find($id);
        $category->name = $request->name;
        $category->address = $request->address;
        $category->phone_number = $request->phone_number;
        $category->delivery = $request->delivery;
        $category->save();

        return redirect('pharmacies')->with('successEditPharm' , 'You have updated pharmacy successfully');
    }
    public function deletePharmacy($id){
        $delete = Pharmacy::destroy($id);
        return redirect('pharmacies')->with('deletePharm' , 'You have deleted pharmacy ');

    }

}
