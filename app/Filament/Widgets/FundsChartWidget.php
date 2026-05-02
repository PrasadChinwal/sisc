<?php

namespace App\Filament\Widgets;

use App\Models\Deposit;
use App\Models\Expense;
use App\Models\Season;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class FundsChartWidget extends ChartWidget
{
    protected ?string $heading = 'Monthly Deposits vs Expenses';

    protected ?string $pollingInterval = null;

    protected function getData(): array
    {
        $season = Season::where('is_active', true)->first();

        $months = collect(range(1, 12))->map(fn (int $m) => Carbon::create(null, $m, 1));

        $deposits = $months->map(function (Carbon $month) use ($season): float {
            if (! $season) {
                return 0;
            }

            return (float) Deposit::where('season_id', $season->id)
                ->whereMonth('deposited_at', $month->month)
                ->whereYear('deposited_at', $month->year)
                ->sum('amount');
        });

        $expenses = $months->map(function (Carbon $month) use ($season): float {
            if (! $season) {
                return 0;
            }

            return (float) Expense::where('season_id', $season->id)
                ->whereMonth('expensed_at', $month->month)
                ->whereYear('expensed_at', $month->year)
                ->sum('amount');
        });

        return [
            'datasets' => [
                [
                    'label' => 'Deposits',
                    'data' => $deposits->values()->all(),
                    'backgroundColor' => '#22c55e',
                    'borderColor' => '#16a34a',
                ],
                [
                    'label' => 'Expenses',
                    'data' => $expenses->values()->all(),
                    'backgroundColor' => '#ef4444',
                    'borderColor' => '#dc2626',
                ],
            ],
            'labels' => $months->map(fn (Carbon $m) => $m->format('M'))->values()->all(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
