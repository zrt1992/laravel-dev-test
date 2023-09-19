<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'products'])->name('products');


Route::group(['middleware' => ['auth','role:admin']], function () {
    Route::get('/home', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.home');
    Route::get('/denyAccess/{user}', [App\Http\Controllers\Admin\AdminController::class, 'denyAccess'])->name('deny-access-control');
});

Route::get('/process-payment/{product}',[App\Http\Controllers\OrdersController::class,'order'])->name('verify-card');

// payment on stripe
Route::post('stripe-payment',[App\Http\Controllers\OrdersController::class,'placeOrder'])->name('stripe-payment');

// payment refund method
Route::get('payment-refund',function(Request $request){
    $user_payment_token = 'pi_3NrlibAR3cNX0XKI1Q8JwXbr';
    $request->user()->refund($user_payment_token);
});
