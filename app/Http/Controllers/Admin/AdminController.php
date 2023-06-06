<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showAdmins(Request $request){
        $admins = User::where('role' , 'admin')->get();
        return view('admin.adminsSetting.showAdmins' , compact('admins'));
    }

    public function createAdmin(Request $request){
        $admin = Admin::find($request->info);
        return view('admin.adminsSetting.createAdmin' , compact('admin'));
    }
    public function storeAdmin(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $newAdmin = new User;
        $newAdmin->name = $request->name;
        $newAdmin->email = $request->email;
        $newAdmin->password = Hash::make($request->password);
        $newAdmin->phone_number = $request->phone;
        $newAdmin->role = 'admin';
        $newAdmin->address = $request->address;
        $newAdmin->save();

        return redirect('admins')->with('addedSuccess' , 'You have added Admin successfully');

    }

    public function editAdmin($id , Request $request){
        $admin = User::find($id);

        return view('admin.adminsSetting.edit' , compact('admin'));
    }

    public function updateAdmin($id , Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'role' => 'required',
            'address' => 'required'
        ]);

        $updatedAdmin = User::find($id);
        $updatedAdmin->name = $request->name;
        $updatedAdmin->email = $request->email;
        $updatedAdmin->phone_number = $request->phone;
        $updatedAdmin->role = $request->role;
        $updatedAdmin->address = $request->address;
        $updatedAdmin->save();

        return redirect('admins')->with('updateAdmin' , 'you updated admin successfully');
    }


    public function deleteAdmin($id){
        $delete = User::destroy($id);
        return redirect()->back()->with('deleteAdmin' , 'you deleted admin successfully');

    }

}
