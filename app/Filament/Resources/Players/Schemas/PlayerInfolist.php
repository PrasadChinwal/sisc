<?php

namespace App\Filament\Resources\Players\Schemas;

use App\Models\Player;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PlayerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Player Details')
                    ->columnSpanFull()
                    ->columns(['md' => 2])
                    ->schema([
                        TextEntry::make('full_name'),
                        TextEntry::make('first_name'),
                        TextEntry::make('last_name'),
                        TextEntry::make('date_of_birth')
                            ->date(),
                        TextEntry::make('email'),
                        TextEntry::make('contact'),
                        TextEntry::make('season.season_name')
                            ->label('Season'),
                        TextEntry::make('positions')
                            ->badge()
                            ->listWithLineBreaks(),
                    ]),
                Section::make('Fee Summary')
                    ->columnSpanFull()
                    ->columns(['md' => 3])
                    ->schema([
                        TextEntry::make('season.registration_fee')
                            ->label('Registration Fee')
                            ->money('usd')
                            ->placeholder('Not set'),
                        TextEntry::make('total_paid')
                            ->label('Total Paid')
                            ->state(fn (Player $record) => $record->totalPaid())
                            ->money('usd'),
                        TextEntry::make('balance')
                            ->label('Balance Remaining')
                            ->state(fn (Player $record) => $record->balance())
                            ->money('usd')
                            ->color(fn (Player $record) => $record->isFullyPaid() ? 'success' : 'danger'),
                    ]),
            ]);
    }
}
