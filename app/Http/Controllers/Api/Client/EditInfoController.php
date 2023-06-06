<?php

namespace App\Http\Controllers\Api\Client;

use App\Models\User;
use App\Helpers\helper;
use Nette\Utils\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class EditInfoController extends Controller
{

    public function __construct(){
        $this->helper = new helper();
    }
    public function settings(Request $request){
        $client = User::find(Auth::user()->id);
        $client->name = isset($request->name) ? $request->name : $client->name;
        $client->email = isset($request->email) ? $request->email : $client->email;
        $client->password = isset($request->password) ? $request->password : Hash::make($client->password);
        $client->address = isset($request->address) ? $request->address : $client->address;
        $client->phone_number = isset($request->phone_number) ? $request->phone_number : $client->phone_number;
        $client->save();

        return $this->helper->ResponseJson(1, __('apis.infoEdit'));

    }
}
