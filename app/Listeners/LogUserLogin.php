<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogUserLogin
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
    public function handle(Login $event): void
    {
        // Get the authenticated user
        $user = $event->user;

        // Store the login details in the login_histories table
        LoginHistory::create([
            'user_id' => $user->id,
            'login_at' => now(),
            'ip_address' => request()->ip(),  // Get the user's IP address
            'user_agent' => request()->header('User-Agent'),  // Get the user's device or browser
        ]);
    }
}
