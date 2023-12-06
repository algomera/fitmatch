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
        Schema::create('anamnesi_personal_trainer', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Anamnesi::class, 'anamnesi_id')->onDelete('cascade');
            $table->foreignIdFor(\App\Models\User::class, 'personal_trainer_id')->onDelete('cascade');
            $table->boolean('accepted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anamnesi_personal_trainer');
    }
};
