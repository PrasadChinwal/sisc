<?php

namespace App\Filament\Widgets;

use App\Models\Season;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FundsOverviewWidget extends BaseWidget
{
    use HasWidgetShield;

    protected function getStats(): array
    {
        $season = Season::where('is_active', true)->first();

        if (! $season) {
            return [
                Stat::make('Total Deposits', '$0.00'),
                Stat::make('Total Expenses', '$0.00'),
                Stat::make('Net Balance', '$0.00'),
            ];
        }

        $totalDeposits = $season->totalDeposits();
        $totalExpenses = $season->totalExpenses();
        $netBalance = $season->netBalance();

        return [
            Stat::make('Total Deposits', '$'.number_format($totalDeposits, 2))
                ->description($season->season_name)
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Expenses', '$'.number_format($totalExpenses, 2))
                ->description($season->season_name)
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Net Balance', '$'.number_format($netBalance, 2))
                ->description($season->season_name)
                ->descriptionIcon('heroicon-m-banknotes')
                ->color($netBalance >= 0 ? 'success' : 'danger'),
        ];
    }
}
