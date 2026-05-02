<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum DepositCategory: string implements HasColor, HasLabel
{
    case PlayerFees = 'player_fees';
    case Sponsorship = 'sponsorship';
    case Fundraiser = 'fundraiser';
    case Donation = 'donation';
    case Other = 'other';

    public function getLabel(): string
    {
        return match ($this) {
            self::PlayerFees => 'Player Fees',
            self::Sponsorship => 'Sponsorship',
            self::Fundraiser => 'Fundraiser',
            self::Donation => 'Donation',
            self::Other => 'Other',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::PlayerFees => 'blue',
            self::Sponsorship => 'green',
            self::Fundraiser => 'orange',
            self::Donation => 'purple',
            self::Other => 'gray',
        };
    }
}
