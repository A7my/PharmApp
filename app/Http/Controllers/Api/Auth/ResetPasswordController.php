<?php

namespace App\Http\Controllers\Api\Auth;

use Otp;
use App\Models\User;
use App\Helpers\helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Notifications\NotificationServiceProvider;

class ResetPasswordController extends Controller
{
    private $otp;

    public function __construct(){
        $this->otp = new Otp;
        $this->helper = new helper();

    }

    public function passwordReset(ResetPasswordRequest $request){
        $otp2 = $this->otp->validate($request->email , $request->otp);
        if(! $otp2->status){
            return $this->helper->ResponseJson(401, __('apis.wrongOTP'));

        }
        $user = User::where('email' , $request->email)->first();
        $user->update(['password' => Hash::make($request->password)]);
        $user->tokens()->delete();
        return $this->helper->ResponseJson(200, __('apis.passwordReset'));

    }
}
