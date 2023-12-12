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
        Schema::create('favorite_exercises', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\User::class)->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Exercise::class)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorite_exercises');
    }
};
