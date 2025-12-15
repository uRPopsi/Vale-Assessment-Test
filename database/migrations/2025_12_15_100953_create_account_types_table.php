<?php

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
    
        //To create account types table i.e FLEX, DELUXE etc with interest rates and minimum balance
    Schema::create('account_types', function (Blueprint $table) {
    $table->id();
    $table->string('name')->unique(); // Account types like FLEX, DELUXE, etc
    $table->decimal('interest_rate', 5, 2); //The interest rates
    $table->decimal('min_balance', 15, 2)->default(20000);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_types');
    }
};
