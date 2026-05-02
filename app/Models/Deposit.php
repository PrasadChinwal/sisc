<?php

namespace App\Models;

use App\Enums\DepositCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deposit extends Model
{
    /** @use HasFactory<\Database\Factories\DepositFactory> */
    use HasFactory;

    protected $fillable = [
        'season_id',
        'fee_id',
        'category',
        'amount',
        'description',
        'notes',
        'deposited_at',
    ];

    public function casts(): array
    {
        return [
            'category' => DepositCategory::class,
            'amount' => 'float',
            'deposited_at' => 'datetime',
        ];
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function fee(): BelongsTo
    {
        return $this->belongsTo(Fee::class);
    }
}
