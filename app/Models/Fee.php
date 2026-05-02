<?php

namespace App\Models;

use App\Observers\FeeObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[ObservedBy([FeeObserver::class])]
class Fee extends Model
{
    /** @use HasFactory<\Database\Factories\FeeFactory> */
    use HasFactory;

    protected $fillable = [
        'player_id',
        'amount',
        'notes',
        'paid_at',
    ];

    public function casts(): array
    {
        return [
            'amount' => 'float',
            'paid_at' => 'datetime',
        ];
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function deposit(): HasOne
    {
        return $this->hasOne(Deposit::class);
    }
}
