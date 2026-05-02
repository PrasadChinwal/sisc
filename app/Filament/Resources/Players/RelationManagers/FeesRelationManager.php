<?php

namespace App\Filament\Resources\Players\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FeesRelationManager extends RelationManager
{
    protected static string $relationship = 'fees';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('amount')
                    ->numeric()
                    ->required()
                    ->prefix('$')
                    ->minValue(0),
                DateTimePicker::make('paid_at')
                    ->required()
                    ->default(now()),
                TextInput::make('notes')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Fee Payments')
            ->columns([
                TextColumn::make('amount')
                    ->money('usd')
                    ->sortable(),
                TextColumn::make('paid_at')
                    ->label('Paid At')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('notes')
                    ->placeholder('—'),
            ])
            ->defaultSort('paid_at', 'desc')
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
