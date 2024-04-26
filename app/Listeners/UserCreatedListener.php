<?php

namespace App\Listeners;

use App\Events\UserCreatedAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UserCreatedListener
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
    public function handle(UserCreatedAction $event): void
    {
        $data = [
            'first_name' => $event->user->first_name,
            'last_name' => $event->user->last_name,
            'email' => $event->user->email
        ];
        Mail::send($data);
    }
}
