<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $orders = $request->user()->orders;
        return view('user.dashboard', compact('orders'));
    }

    /**
     * Show the websites products page with listing
     */
    public function products()
    {
        $products = Product::get();
        return view('website.products', compact('products'));
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return void
     */
    public function refundPayment(Request $request, Order $order)
    {
        try {
            DB::beginTransaction();
            $request->user()->refund($order->payment_token);
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back();
        }
    }
}
