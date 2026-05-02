<?php

namespace App\Observers;

use App\Enums\DepositCategory;
use App\Models\Deposit;
use App\Models\Fee;

class FeeObserver
{
    public function created(Fee $fee): void
    {
        $player = $fee->player;

        Deposit::create([
            'season_id' => $player->season_id,
            'fee_id' => $fee->id,
            'category' => DepositCategory::PlayerFees,
            'amount' => $fee->amount,
            'description' => "Fee payment – {$player->full_name}",
            'notes' => $fee->notes,
            'deposited_at' => $fee->paid_at,
        ]);
    }

    public function updated(Fee $fee): void
    {
        $fee->deposit?->update([
            'amount' => $fee->amount,
            'notes' => $fee->notes,
            'deposited_at' => $fee->paid_at,
        ]);
    }

    public function deleted(Fee $fee): void
    {
        $fee->deposit?->delete();
    }
}
