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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\ExerciseTypology::class, 'typology_id');
            $table->foreignIdFor(\App\Models\ExerciseZone::class, 'zone_id');
            $table->foreignIdFor(\App\Models\ExerciseArea::class, 'area_id');
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->text('link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
