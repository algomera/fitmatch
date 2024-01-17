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
        Schema::create('personal_trainer_athlete', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class, 'personal_trainer_id');
            $table->foreignIdFor(\App\Models\User::class, 'athlete_id');
            $table->boolean('accepted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_trainer_athlete');
    }
};
