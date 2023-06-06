<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PharmacyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeliveryManController;
use App\Http\Controllers\DeliveryMen\MyOrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', function () {
//     return view('dashboard');
// });
// Route::get('/' , [DashboardController::class , 'dashboard'])->middleware(['auth'])->name('dashboard');
// Route::redirect('/', '/login', 301);
// Route::match(['get', 'post'], '/', function () {
    //     return redirect('/login');
// });




require __DIR__.'/auth.php';

// Route::redirect('/', '/dashboard');
Route::get('/' , [DashboardController::class , 'dashboard'])->middleware(['auth']);

Route::get('/dashboard' , [DashboardController::class , 'dashboard'])->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('admins' , [AdminController::class , 'showAdmins'])->middleware('admin');
    Route::get('createAdmin' , [AdminController::class , 'createAdmin'])->middleware('admin');
    Route::post('storeAdmin' , [AdminController::class , 'storeAdmin'])->middleware('admin');
    Route::post('editAdmin/{id}' , [AdminController::class , 'editAdmin'])->middleware('admin');
    Route::get('editAdmin/{id}' , [AdminController::class , 'editAdmin'])->middleware('admin');
    Route::post('updateAdmin/{id}' , [AdminController::class , 'updateAdmin'])->middleware('admin');
    Route::get('updateAdmin/{id}' , [AdminController::class , 'updateAdmin'])->middleware('admin');
    Route::post('deleteAdmin/{id}' , [AdminController::class , 'deleteAdmin'])->middleware('admin');

    Route::get('categories' , [CategoryController::class , 'showCategories'])->middleware('admin');
    Route::get('createCategory' , [CategoryController::class , 'createCategory'])->middleware('admin');
    Route::post('storeCategory' , [CategoryController::class , 'storeCategory'])->middleware('admin');
    Route::post('editCategory/{id}' , [CategoryController::class , 'editCategory'])->middleware('admin');
    Route::get('editCategory/{id}' , [CategoryController::class , 'editCategory'])->middleware('admin');
    Route::post('updateCategory/{id}' , [CategoryController::class , 'updateCategory'])->middleware('admin');
    Route::get('updateCategory/{id}' , [CategoryController::class , 'updateCategory'])->middleware('admin');
    Route::post('deleteCategory/{id}' , [CategoryController::class , 'deleteCategory'])->middleware('admin');

    Route::get('pharmacies' , [PharmacyController::class , 'showPharms'])->middleware('admin');
    Route::get('createPharmacy' , [PharmacyController::class , 'createPharmacy'])->middleware('admin');
    Route::post('storePharmacy' , [PharmacyController::class , 'storePharmacy'])->middleware('admin');
    Route::post('editPharmacy/{id}' , [PharmacyController::class , 'editPharmacy'])->middleware('admin');
    Route::get('editPharmacy/{id}' , [PharmacyController::class , 'editPharmacy'])->middleware('admin');
    Route::post('updatePharmacy/{id}' , [PharmacyController::class , 'updatePharmacy'])->middleware('admin');
    Route::get('updatePharmacy/{id}' , [PharmacyController::class , 'updatePharmacy'])->middleware('admin');
    Route::post('deletePharmacy/{id}' , [PharmacyController::class , 'deletePharmacy'])->middleware('admin');

    Route::get('products' , [ProductController::class , 'products'])->middleware('admin');
    Route::get('createProduct' , [ProductController::class , 'createProduct'])->middleware('admin');
    Route::post('storeProduct' , [ProductController::class , 'storeProduct'])->middleware('admin');
    Route::post('editProduct/{id}' , [ProductController::class , 'editProduct'])->middleware('admin');
    Route::get('editProduct/{id}' , [ProductController::class , 'editProduct'])->middleware('admin');
    Route::post('updateProduct/{id}' , [ProductController::class , 'updateProduct'])->middleware('admin');
    Route::put('updateProduct/{id}' , [ProductController::class , 'updateProduct'])->middleware('admin');
    Route::post('deleteProduct/{id}' , [ProductController::class , 'deleteProduct'])->middleware('admin');

    Route::get('orders' , [OrderController::class , 'orders'])->middleware('admin');
    Route::post('recordOrder' , [OrderController::class , 'recordOrder'])->middleware('admin');

    Route::get('myorders' , [MyOrderController::class , 'myorders']);
    Route::post('myorder/{id}' , [MyOrderController::class , 'myorder']);
    Route::post('readNotification/{id}' , [MyOrderController::class , 'readNotification']);
    Route::post('readAllNotification' , [MyOrderController::class , 'readAllNotification']);

    Route::get('deliverymen' , [DeliveryManController::class , 'deliverymen'])->middleware('admin');
    Route::get('createDeliveryman' , [DeliveryManController::class , 'createDeliveryman'])->middleware('admin');
    Route::post('storeDeliveryman' , [DeliveryManController::class , 'storeDeliveryman'])->middleware('admin');
    Route::post('editDeliveryman/{id}' , [DeliveryManController::class , 'editDeliveryman'])->middleware('admin');
    Route::get('editDeliveryman/{id}' , [DeliveryManController::class , 'editDeliveryman'])->middleware('admin');
    Route::post('updateDeliveryman/{id}' , [DeliveryManController::class , 'updateDeliveryman'])->middleware('admin');
    Route::get('updateDeliveryman/{id}' , [DeliveryManController::class , 'updateDeliveryman'])->middleware('admin');
    Route::post('deleteDeliveryman/{id}' , [DeliveryManController::class , 'deleteDeliveryman'])->middleware('admin');

});
