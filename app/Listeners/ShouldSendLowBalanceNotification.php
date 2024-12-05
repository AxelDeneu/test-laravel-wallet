<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Enums\WalletTransactionType;
use App\Events\NewTransaction;
use App\Notifications\LowBalance;

class ShouldSendLowBalanceNotification
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
    public function handle(NewTransaction $event): void
    {
        // first, make sure it's a debit transaction, if not, return
        // I don't find useful to notify the user about his balance if he top it up with 5€ for example.
        if ($event->type !== WalletTransactionType::DEBIT) {
            return;
        }

        // as the transaction already happened, we can check the wallet balance, if it's below 10€, send a notification
        if ($event->wallet->balance >= 1000) {
            return;
        }

        $event->wallet->user->notify(new LowBalance);
    }
}
