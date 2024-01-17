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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personal_trainer_id')->constrained('users');
            $table->foreignId('athlete_id')->constrained('users');
            $table->text('description');
            $table->boolean('is_confirmed')->default(false);
            $table->boolean('is_free')->default(false);
            $table->decimal('price', 6, 2)->default(0.00);
            $table->integer('session_number')->default(1);
            $table->dateTime('date')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
