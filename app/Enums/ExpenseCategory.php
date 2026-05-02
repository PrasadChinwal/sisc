<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ExpenseCategory: string implements HasColor, HasLabel
{
    case Equipment = 'equipment';
    case Travel = 'travel';
    case Venue = 'venue';
    case Referee = 'referee';
    case Training = 'training';
    case Administrative = 'administrative';
    case Other = 'other';

    public function getLabel(): string
    {
        return match ($this) {
            self::Equipment => 'Equipment',
            self::Travel => 'Travel',
            self::Venue => 'Venue',
            self::Referee => 'Referee',
            self::Training => 'Training',
            self::Administrative => 'Administrative',
            self::Other => 'Other',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Equipment => 'red',
            self::Travel => 'yellow',
            self::Venue => 'blue',
            self::Referee => 'green',
            self::Training => 'indigo',
            self::Administrative => 'gray',
            self::Other => 'gray',
        };
    }
}
