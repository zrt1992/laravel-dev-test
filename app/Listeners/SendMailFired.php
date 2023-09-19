<?php

namespace App\Listeners;

use App\Events\Cancellation;
use App\Mail\CancellationEmail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailFired
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
        $user = User::find($event->userId)->toArray();
        Mail::send(new CancellationEmail($user), $user, function($message) use ($user) {

            $message->to($user['email']);

            $message->subject('Event Testing');

        });
    }
}
