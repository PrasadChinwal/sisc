<?php

namespace App\Filament\Resources\Deposits\Schemas;

use App\Enums\DepositCategory;
use App\Models\Season;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DepositForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Deposit Details')
                    ->columnSpanFull()
                    ->columns(['md' => 2])
                    ->schema([
                        Select::make('season_id')
                            ->label('Season')
                            ->options(fn () => Season::orderByDesc('season_name')->pluck('season_name', 'id'))
                            ->default(fn () => Season::where('is_active', true)->value('id'))
                            ->required(),
                        Select::make('category')
                            ->options(DepositCategory::class)
                            ->required(),
                        TextInput::make('amount')
                            ->numeric()
                            ->required()
                            ->prefix('$')
                            ->minValue(0),
                        DateTimePicker::make('deposited_at')
                            ->label('Deposited At')
                            ->required()
                            ->default(now()),
                        TextInput::make('description')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('notes')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
