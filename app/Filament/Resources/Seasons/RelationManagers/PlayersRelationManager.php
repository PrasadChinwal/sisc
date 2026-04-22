<?php

namespace App\Filament\Resources\Seasons\RelationManagers;

use App\Filament\Resources\Players\PlayerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class PlayersRelationManager extends RelationManager
{
    protected static string $relationship = 'players';

    protected static ?string $relatedResource = PlayerResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Current Season Players:')
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
