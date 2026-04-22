<?php

namespace App\Filament\Resources\Players\Schemas;

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
                    ->columns([
                        'md' => 2,
                    ])
                    ->schema([
                        TextEntry::make('full_name'),
                        TextEntry::make('first_name'),
                        TextEntry::make('last_name'),
                        TextEntry::make('date_of_birth')
                            ->date(),
                        TextEntry::make('email'),
                        TextEntry::make('contact'),
                        TextEntry::make('positions')
                            ->badge()
                            ->listWithLineBreaks(),
                    ]),
            ]);
    }
}
