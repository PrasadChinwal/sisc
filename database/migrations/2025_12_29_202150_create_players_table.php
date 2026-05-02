<?php

use App\Models\Season;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Season::class)
                ->constrained();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('full_name')
                ->virtualAs('CONCAT(first_name, " ", last_name)');
            $table->date('date_of_birth')->nullable();
            $table->string('email');
            $table->string('contact');
            $table->longText('positions')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['season_id', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
