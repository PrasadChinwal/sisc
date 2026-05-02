<?php

namespace App\Filament\Resources\Players\Schemas;

use App\Enums\PlayingPosition;
use App\Models\Season;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PlayerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Player Details')
                    ->columnSpanFull()
                    ->columns([
                        'md' => 2,
                    ])
                    ->schema([
                        Select::make('season_id')
                            ->label('Season')
                            ->options(fn () => Season::orderByDesc('season_name')->pluck('season_name', 'id'))
                            ->default(fn () => Season::where('is_active', true)->value('id'))
                            ->required()
                            ->columnSpanFull(),
                        TextEntry::make('full_name'),
                        TextInput::make('first_name')
                            ->required(),
                        TextInput::make('last_name')
                            ->required(),
                        DatePicker::make('date_of_birth')
                            ->required(),
                        TextInput::make('email')
                            ->email()
                            ->required(),
                        TextInput::make('contact')
                            ->tel()
                            ->length(10)
                            ->required(),
                        Select::make('positions')
                            ->required()
                            ->multiple()
                            ->options(PlayingPosition::class),
                    ]),
            ]);
    }
}
