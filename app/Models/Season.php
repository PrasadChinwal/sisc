<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Season extends Model
{
    /** @use HasFactory<\Database\Factories\SeasonFactory> */
    use HasFactory;

    protected $guarded = [];

    public function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'registration_fee' => 'float',
        ];
    }

    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }

    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function totalDeposits(): float
    {
        return (float) $this->deposits()->sum('amount');
    }

    public function totalExpenses(): float
    {
        return (float) $this->expenses()->sum('amount');
    }

    public function netBalance(): float
    {
        return $this->totalDeposits() - $this->totalExpenses();
    }
}
