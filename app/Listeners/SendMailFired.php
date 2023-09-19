<?php

namespace App\Listeners;

use App\Events\SendUserMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
    public function handle(SendUserMail $event): void
    {
        $user = User::find($event->userId)->toArray();
        dd($user);

        Mail::send('emails.mailEvent', $user, function($message) use ($user) {

            $message->to($user['email']);

            $message->subject('Event Testing');

        });
    }
}
