<?php

declare(strict_types=1);

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class CreateUserWallet
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
    public function handle(Registered $event): void
    {
        // create the dependant wallet, the user should always have his wallet
        $event->user->wallet()->create([
            'balance' => 0,
        ]);
    }
}
