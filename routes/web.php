<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/verify-card',function(){
    return view('varify-card');
})->name('verify-card');

// payment on stripe
Route::post('stripe-payment',function(Request $request){
    // dd($request->all());
    $stripeCharge = $request->user()->charge(
        1000, $request->payment_token
    );
    $user_card_last_4_digits = $request->card_last_4_digits;
    $user_name = $request->name;
    $user_email = $request->email;
    $user_phone_number = $request->phone_number;
    $user_payment_token =$stripeCharge->id;
    dd($stripeCharge->id);
    // $request->refund($stripeCharge->id);
    return redirect()->route('home');
})->name('stripe-payment');

// payment refund method
Route::get('payment-refund',function(Request $request){
    $user_payment_token = 'pi_3NrlibAR3cNX0XKI1Q8JwXbr';
    $request->user()->refund($user_payment_token);
});

Route::get('/charge-checkout', function (Request $request) {
    $user = User::where('email','test@example.com')->first();
    $userinfo = $user->checkoutCharge(100, 'O-Neil-Shoes', 1);
    // dd($userinfo);
    return $userinfo;
});

Route::get('/checkout-success', function (Request $request) {
    $checkoutSession = $request->user()->stripe()->checkout->sessions->retrieve($request->get('session_id'));
    dd($checkoutSession);
    return view('welcome');
})->name('checkout-success');
Route::get('/checkout-cancel', function () {
    return view('welcome');
})->name('checkout-cancel');