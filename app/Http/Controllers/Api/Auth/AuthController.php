<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Helpers\helper;
use App\Models\Message;
use Nette\Utils\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Http\Request;


class AuthController extends Controller
{

    public function __construct(){
        $this->helper = new helper();
    }

    public function register(RegisterRequest $request){

        $request->validate([

        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'client';
        $user->save();

        $user->notify(new EmailVerificationNotification);
        return $this->helper->ResponseJson(1, __('apis.register'), $user);
    }

    public function login(LoginRequest $request ){

        $request->validate([
        ]);


        $user = User::where('email' , $request->email)->first();
        if(isset($user)){
            if(Hash::check($request->password , $user->password)){
                $token = $user->createToken("auth_token")->plainTextToken;
                return $this->helper->ResponseJson(1,__('apis.signed') ,[
                    'token' => $token
                ]);
            }else{
                return $this->helper->ResponseJson(0, __('apis.loggedError1'));
            }
        }else{
            return $this->helper->ResponseJson(0, __('apis.loggedError2'));
        }
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return $this->helper->ResponseJson(2, __('apis.loggedOut'));
    }

}
