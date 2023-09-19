<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;

class OrdersController extends Controller
{
    /**
     * get order id from product and start processing order
     * redirect the user to payment page to get personal information and payment information
     */
    public function order(Product $product)
    {
        // dd($product);
        return view('varify-card',compact('product'));
    }

    /**
     * get payment token on card verification and get user information.
     * Register the user on the given information and assign the role 
     * according to the product type.
     * create an order and fire an email to the user for order success and for login credential.
     */
    public function placeOrder(Request $request)
    {
        $data = ['name' => $request->name,'email' => $request->email,'password' => Hash::make('123456')];
        $product = Product::find($request->product_id);
        $user = User::create($data);
        $user->assignRole($product->type);
        $price = ($product->price * $request->qty) * 100;
        $stripeCharge = $user->charge(
            $price, $request->payment_token
        );
        $user_card_last_4_digits = $request->card_last_4_digits;
        $user_payment_token = $stripeCharge->id;

        if($user_payment_token)
        {
            $order = Order::create(['user_id' => $user->id,'product_id' => $product->id ,'quantity' => $request->qty,'payment_reference' => $user_payment_token,'card_number' => $user_card_last_4_digits,'total' => ($price/100)]);
        }else{
            $user->removeRole($product->type);
            $user->delete();
        }
        return redirect()->route('products');
    }
}
