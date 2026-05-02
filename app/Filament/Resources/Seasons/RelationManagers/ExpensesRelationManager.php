<?php

namespace App\Filament\Resources\Seasons\RelationManagers;

use App\Enums\ExpenseCategory;
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

class ExpensesRelationManager extends RelationManager
{
    protected static string $relationship = 'expenses';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category')
                    ->options(ExpenseCategory::class)
                    ->required(),
                TextInput::make('amount')
                    ->numeric()
                    ->required()
                    ->prefix('$')
                    ->minValue(0),
                DateTimePicker::make('expensed_at')
                    ->label('Expense Date')
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
            ->heading('Expenses')
            ->columns([
                TextColumn::make('category')->badge()->sortable(),
                TextColumn::make('description')->limit(40),
                TextColumn::make('amount')->money('usd')->sortable(),
                TextColumn::make('expensed_at')->label('Date')->date()->sortable(),
            ])
            ->defaultSort('expensed_at', 'desc')
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
