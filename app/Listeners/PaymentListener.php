<?php

namespace App\Listeners;

use App\Events\Cancellation;
use App\Events\Payment;
use App\Mail\CancellationEmail;
use App\Mail\PaymentEmail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class PaymentListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Payment $event): void
    {
        $order = $event->order;
        Mail::to($order->user->email)->send(new PaymentEmail($order));
    }
}
