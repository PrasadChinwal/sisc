<?php

namespace App\Filament\Resources\Seasons\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SeasonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('season_name')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('registration_fee')
                    ->label('Registration Fee')
                    ->numeric()
                    ->prefix('$')
                    ->minValue(0),
            ]);
    }
}
