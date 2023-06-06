<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DeliveryManController extends Controller
{
    public function deliverymen(){
        $d_men = User::where('role' , 'd.man')->get();
        return view('admin.deliverymenSetting.show' , compact('d_men'));
    }
    public function createDeliveryman(){
        return view('admin.deliverymenSetting.create');

    }
    public function editDeliveryman($id , Request $request){
        $d_men = User::find($id);

        return view('admin.deliverymenSetting.edit' , compact('d_men'));
    }

    public function updateDeliveryman($id , Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $updatedAdmin = User::find($id);
        $updatedAdmin->name = $request->name;
        $updatedAdmin->email = $request->email;
        $updatedAdmin->phone_number = $request->phone;
        $updatedAdmin->address = $request->address;
        $updatedAdmin->save();

        return redirect('deliverymen')->with('updateAdmin' , 'you updated delivery man successfully');
    }

    public function storeDeliveryman(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'phone' => 'required|integer',
            'address' => 'required'
        ]);

        $newAdmin = new User;
        $newAdmin->name = $request->name;
        $newAdmin->email = $request->email;
        $newAdmin->password = Hash::make($request->password);
        $newAdmin->phone_number = $request->phone;
        $newAdmin->role = 'd.man';
        $newAdmin->address = $request->address;
        $newAdmin->save();

        return redirect('deliverymen')->with('addedSuccess' , 'You have added Delivery Man successfully');
    }
    public function deleteDeliveryman($id){
        $delete = User::destroy($id);
        return redirect()->back()->with('deleteAdmin' , 'you deleted delivery man successfully');
    }
}
