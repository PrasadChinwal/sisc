<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    /** @use HasFactory<\Database\Factories\PlayerFactory> */
    use HasFactory;

    protected $guarded = [];

    public function casts(): array
    {
        return [
            'positions' => 'json',
        ];
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function fees(): HasMany
    {
        return $this->hasMany(Fee::class);
    }

    public function totalPaid(): float
    {
        return (float) $this->fees()->sum('amount');
    }

    public function balance(): float
    {
        $registrationFee = (float) ($this->season?->registration_fee ?? 0);

        return $registrationFee - $this->totalPaid();
    }

    public function isFullyPaid(): bool
    {
        return $this->balance() <= 0;
    }
}
