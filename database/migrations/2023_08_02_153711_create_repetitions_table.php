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
        Schema::create('repetitions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Workout::class, 'workout_id')->constrained();
            $table->foreignIdFor(\App\Models\WorkoutWeek::class, 'workout_week_id')->constrained();
            $table->integer('quantity')->default(0);
            $table->integer('executed')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repetitions');
    }
};
