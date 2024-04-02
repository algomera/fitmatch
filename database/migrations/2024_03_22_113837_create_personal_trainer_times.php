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
        Schema::create('personal_trainer_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personal_trainer_id')->constrained('users');
            $table->enum('type', ['morning', 'afternoon', 'evening'])->default('morning');
            $table->time('from');
            $table->time('to');
            $table->integer('step');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_trainer_times');
    }
};
