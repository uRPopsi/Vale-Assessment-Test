<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void //function to create transactions table upon running php artisan migrate
    {
        Schema::create('transactions', function (Blueprint $table) {
    $table->id();

    $table->foreignId('account_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->enum('transaction_type', ['CREDIT', 'DEBIT']);
    $table->decimal('amount', 15, 2);
    $table->decimal('balance_before', 15, 2);
    $table->decimal('balance_after', 15, 2);
    $table->string('reference')->unique();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
