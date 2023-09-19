<?php

namespace App\Listeners;

use App\Events\Cancellation;
use App\Mail\CancellationEmail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param Cancellation $event
     * @return void
     */
    public function handle(Cancellation $event): void
    {
        $user = User::find($event->userId)->toArray();
        Mail::to($user['email'])->send(new CancellationEmail($user));
    }
}
