<?php

namespace App\Events;

use App\Enums\WalletTransactionType;
use App\Models\Wallet;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewTransaction
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The User's Wallet
     *
     * @var Wallet
     */
    public Wallet $wallet;

    /**
     * The transaction's type
     *
     * @var WalletTransactionType
     */
    public WalletTransactionType $type;

    /**
     * Create a new event instance.
     */
    public function __construct(Wallet $wallet, WalletTransactionType $type)
    {
        $this->wallet = $wallet;
        $this->type = $type;
    }
}
