<?php

namespace App\Filament\Resources\Players\Tables;

use App\Models\Player;
use App\Models\Season;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PlayersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('season.season_name')
                    ->label('Season')
                    ->sortable(),
                TextColumn::make('full_name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('contact')
                    ->sortable(),
                TextColumn::make('positions')
                    ->badge()
                    ->listWithLineBreaks(),
                TextColumn::make('total_paid')
                    ->label('Total Paid')
                    ->state(fn (Player $record) => $record->totalPaid())
                    ->money('usd')
                    ->sortable(false),
                TextColumn::make('balance')
                    ->label('Balance')
                    ->state(fn (Player $record) => $record->balance())
                    ->money('usd')
                    ->color(fn (Player $record) => $record->isFullyPaid() ? 'success' : 'danger')
                    ->sortable(false),
            ])
            ->filters([
                SelectFilter::make('season_id')
                    ->label('Season')
                    ->options(fn () => Season::orderByDesc('season_name')->pluck('season_name', 'id'))
                    ->default(fn () => Season::where('is_active', true)->value('id'))
                    ->placeholder('All seasons'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
