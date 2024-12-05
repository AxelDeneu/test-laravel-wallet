<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecurringTransfersController
{
    public function __invoke(Request $request)
    {
        $recurringTransfers = $request->user()->recurringTransfers;
        $balance = $request->user()->wallet->balance;

        return view('recurring-transfers.index', compact('recurringTransfers', 'balance'));
    }
}
