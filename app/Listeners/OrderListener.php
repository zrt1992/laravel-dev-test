<?php

namespace App\Listeners;

use App\Events\Cancellation;
use App\Mail\CancellationEmail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class OrderListener
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
    public function handle(Cancellation $event): void
    {
        $order = $event->order;
        Mail::send(new CancellationEmail($event->order), $order, function($message) use ($user) {

            $message->to($order->user());

            $message->subject('Event Testing');

        });
    }
}
