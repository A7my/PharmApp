<?php

namespace App\Http\Controllers\Api\Auth;

use Otp;
use App\Models\User;
use App\Helpers\helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EmailVerificationRequest;
use App\Notifications\EmailVerificationNotification;

class EmailVerificationController extends Controller
{
    private $otp;

    public function __construct()
    {
        $this->otp = new Otp;
        $this->helper = new helper();
    }

    public function email_verification(EmailVerificationRequest $request){
        $otp2 = $this->otp->validate($request->email , $request->otp);

        if(!$otp2->status){
            return $this->helper->ResponseJson(0, __('apis.wrongOTP'));

        }

        $user = User::where('email' , $request->email)->first();

        $updateUser = User::find($user->id);
        $updateUser->email_verified_at = now();
        $updateUser->save();

        return $this->helper->ResponseJson(200, __('apis.mailConfirmed'));
    }

    public function sendEmailVerification(Request $request){

        $mail_status = User::where('email' , $request->email)->value('email_verified_at');

        if($mail_status == NULL){
            $request->user()->notify(new EmailVerificationNotification());
            $success['success'] = "We have sent you a message AGAIN for mail verification";
            return $this->helper->ResponseJson(200, $success);
        }else{
            return $this->helper->ResponseJson(200, "You Have Already Verified ur mail");
        }


    }
}
