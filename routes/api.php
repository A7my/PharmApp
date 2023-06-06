<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Cart\CartController;
use App\Http\Controllers\Api\Product\SearchController;
use App\Http\Controllers\Api\Client\EditInfoController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Product\UserCartController;
use App\Http\Controllers\Api\Order\ClientOrderController;
use App\Http\Controllers\Api\Pharmacy\PharmacyController;
use App\Http\Controllers\Api\Product\AddToCartController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\ForgetPasswordController;
use App\Http\Controllers\Api\Auth\EmailVerificationController;
use App\Http\Controllers\Api\Product\DeleteFromCartController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:sanctum', 'second'])->get( '/user' , function (Request $request) {
    return $request->user();
});





Route::prefix('v1')->group(function () {


    Route::middleware(['api-lang'])->group(function () {

    Route::post('register' , [AuthController::class , 'register']);
    Route::post('login' , [AuthController::class , 'login']);
    Route::post('forget-password' , [ForgetPasswordController::class , 'forgetPassword']);
    Route::post('reset-password' , [ResetPasswordController::class , 'passwordReset']);

    });

    Route::middleware(['auth:sanctum' , 'api-lang'])->group(function () {

        Route::post('email_verify' , [EmailVerificationController::class , 'email_verification']);
        Route::post('send_verification_code' , [EmailVerificationController::class , 'sendEmailVerification']);
        Route::post('logout' , [ AuthController::class,'logout']);

        // Route::post('product/delete/{id}' , [DeleteFromCartController::class , 'delete']);

        Route::post('product/search' ,  [ProductController::class , 'searchProduct']);
        Route::post('product/{id}' , [ProductController::class , 'product']);
        Route::post('pharmacy/search' ,  [PharmacyController::class , 'pharmacySearch']);
        Route::post('pharmacy/{id}' ,  [PharmacyController::class , 'pharmacy']);
        Route::post('pharmacy/{id}/product' ,  [PharmacyController::class , 'productPharmacySearch']);

        Route::post('addToCart/{id}' , [CartController::class , 'addToCart']);
        Route::get('myCart' , [CartController::class , 'myCart']);
        Route::post('myCart/delete/{id}' , [CartController::class , 'deleteFromMyCart']);

        Route::post('createOrder' , [ClientOrderController::class , 'createOrder']);
        Route::post('acceptOrder' , [ClientOrderController::class , 'acceptOrder']);
        Route::get('myOrders' , [ClientOrderController::class , 'myOrders']);

        Route::post('setting' , [EditInfoController::class , 'settings']);
    });
});
