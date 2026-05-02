<?php

namespace App\Filament\Resources\Expenses\Tables;

use App\Models\Season;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ExpensesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('season.season_name')
                    ->label('Season')
                    ->sortable(),
                TextColumn::make('category')
                    ->badge()
                    ->sortable(),
                TextColumn::make('description')
                    ->searchable()
                    ->limit(40),
                TextColumn::make('amount')
                    ->money('usd')
                    ->sortable(),
                TextColumn::make('expensed_at')
                    ->label('Date')
                    ->date()
                    ->sortable(),
            ])
            ->defaultSort('expensed_at', 'desc')
            ->filters([
                SelectFilter::make('season_id')
                    ->label('Season')
                    ->options(fn () => Season::orderByDesc('season_name')->pluck('season_name', 'id'))
                    ->default(fn () => Season::where('is_active', true)->value('id'))
                    ->placeholder('All seasons'),
                SelectFilter::make('category')
                    ->options(\App\Enums\ExpenseCategory::class),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
