<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exercise_workout_serie', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\WorkoutSet::class, 'workout_serie_id')->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Exercise::class, 'exercise_id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_workout_serie');
    }
};
