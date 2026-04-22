<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PlayingPosition: string implements HasLabel, HasColor
{
    case Goalkeeper = 'Goalkeeper';

    case Defender = 'Defender';

    case Midfielder = 'Midfielder';

    case Forward = 'Forward';

    public function getLabel(): string
    {
        return match ($this) {
            self::Goalkeeper => 'Goalkeeper',
            self::Defender => 'Defender',
            self::Midfielder => 'Midfielder',
            self::Forward => 'Forward',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Goalkeeper => 'red',
            self::Defender => 'blue',
            self::Midfielder => 'yellow',
            self::Forward => 'green',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
