<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void //function to create interest histories table upon running php artisan migrate
    {
        Schema::create('interest_histories', function (Blueprint $table) {
    $table->id();

    $table->foreignId('account_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->decimal('interest_rate', 5, 2);
    $table->decimal('interest_amount', 15, 2);
    $table->decimal('balance_at_calculation', 15, 2);
    $table->timestamp('calculated_at');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interest_histories');
    }
};
