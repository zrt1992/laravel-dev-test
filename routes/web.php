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

Route::group([['prefix' => 'admin'],'middleware' => ['auth','role:admin']], function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.home');
    Route::get('/denyAccess/{user}', [App\Http\Controllers\Admin\AdminController::class, 'denyAccess'])->name('deny-access-control');
});

Route::group([['prefix' => 'customer'],'middleware' => ['auth','role:customer|B2B|B2C']], function () {
    Route::get('/', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.dashboard');
    Route::get('/products', [App\Http\Controllers\CustomerController::class, 'products'])->name('products');
    Route::get('/payment-refund/{order}',[App\Http\Controllers\CustomerController::class, 'refundPayment'])->name('payment.refund');
    Route::get('/process-payment/{product}',[App\Http\Controllers\OrdersController::class,'order'])->name('verify-card');
    Route::post('stripe-payment',[App\Http\Controllers\OrdersController::class,'placeOrder'])->name('stripe-payment');
});

Auth::routes();



