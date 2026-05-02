<?php

use App\Enums\ExpenseCategory;
use App\Models\Expense;
use App\Models\Season;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('an expense belongs to a season', function () {
    $season = Season::factory()->create();
    $expense = Expense::factory()->create(['season_id' => $season->id]);

    expect($expense->season)->toBeInstanceOf(Season::class)
        ->and($expense->season->id)->toBe($season->id);
});

it('a season has many expenses', function () {
    $season = Season::factory()->create();
    Expense::factory()->count(3)->create(['season_id' => $season->id]);

    expect($season->expenses)->toHaveCount(3);
});

it('calculates total expenses for a season', function () {
    $season = Season::factory()->create();
    Expense::factory()->create(['season_id' => $season->id, 'amount' => 80.00]);
    Expense::factory()->create(['season_id' => $season->id, 'amount' => 120.00]);

    expect($season->totalExpenses())->toBe(200.0);
});

it('calculates net balance correctly', function () {
    $season = Season::factory()->create();

    \App\Models\Deposit::factory()->create(['season_id' => $season->id, 'amount' => 500.00]);
    Expense::factory()->create(['season_id' => $season->id, 'amount' => 200.00]);

    expect($season->netBalance())->toBe(300.0);
});

it('net balance is negative when expenses exceed deposits', function () {
    $season = Season::factory()->create();

    \App\Models\Deposit::factory()->create(['season_id' => $season->id, 'amount' => 100.00]);
    Expense::factory()->create(['season_id' => $season->id, 'amount' => 300.00]);

    expect($season->netBalance())->toBe(-200.0);
});

it('expense category is cast to enum', function () {
    $expense = Expense::factory()->create(['category' => ExpenseCategory::Equipment]);

    expect($expense->category)->toBe(ExpenseCategory::Equipment);
});

it('deleting a season cascades to its expenses', function () {
    $season = Season::factory()->create();
    Expense::factory()->count(2)->create(['season_id' => $season->id]);

    $season->delete();

    expect(Expense::where('season_id', $season->id)->count())->toBe(0);
});
