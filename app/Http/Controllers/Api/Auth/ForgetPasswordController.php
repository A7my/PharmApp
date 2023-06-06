<?php

namespace App\Http\Controllers\Api\Auth;

use Otp;
use App\Models\User;
use App\Helpers\helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\ResetPasswordNotification;
use App\Http\Requests\Auth\ForgetPasswordRequest;

class ForgetPasswordController extends Controller
{
    public function __construct()
    {
        $this->helper = new helper();
    }

    public function forgetPassword(ForgetPasswordRequest $request){
        $input = $request->only('email');
        $user = User::where('email' , $input)->first();
        $user->notify(new ResetPasswordNotification());
        return $this->helper->ResponseJson(200, __('apis.passwordResetOTP'));

    }
}
