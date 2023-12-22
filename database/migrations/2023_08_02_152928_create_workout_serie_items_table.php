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
        Schema::create('workout_serie_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Workout::class, 'workout_id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Models\WorkoutSerie::class, 'workout_serie_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('item_id');
            $table->string('item_type');
            $table->foreignIdFor(\App\Models\Intensity::class)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_serie_items');
    }
};
