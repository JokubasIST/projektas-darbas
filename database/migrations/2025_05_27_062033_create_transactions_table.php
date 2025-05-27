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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 10, 2); // suma
            $table->text('description')->nullable(); // aprašymas (nebūtinas)
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // ryšys su kategorija
            $table->foreignId('user_id')->constrained()->onDelete('cascade');     // ryšys su vartotoju
            $table->date('date'); // transakcijos data
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
