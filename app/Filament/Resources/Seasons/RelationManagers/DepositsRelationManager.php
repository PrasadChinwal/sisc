<?php

namespace App\Filament\Resources\Seasons\RelationManagers;

use App\Enums\DepositCategory;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DepositsRelationManager extends RelationManager
{
    protected static string $relationship = 'deposits';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Deposits')
            ->columns([
                TextColumn::make('category')->badge()->sortable(),
                TextColumn::make('description')->limit(40),
                TextColumn::make('amount')->money('usd')->sortable(),
                TextColumn::make('deposited_at')->label('Date')->date()->sortable(),
            ])
            ->defaultSort('deposited_at', 'desc')
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
