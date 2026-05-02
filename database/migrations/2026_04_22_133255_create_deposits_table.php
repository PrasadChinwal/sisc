<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Season::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Fee::class)->nullable()->constrained()->nullOnDelete();
            $table->string('category');
            $table->decimal('amount', 8, 2);
            $table->string('description');
            $table->text('notes')->nullable();
            $table->dateTime('deposited_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
