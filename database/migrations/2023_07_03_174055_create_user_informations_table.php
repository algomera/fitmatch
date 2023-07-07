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
        Schema::create('user_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class, 'user_id');
            // Informazioni personali
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('dob')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            // Profile
            $table->enum('profile_type', [
                'public',
                'private'
            ])->nullable();
            // Lezioni
            $table->boolean('remote')->default(false);
            $table->boolean('in_person')->default(false);
            // Informazioni aziendali
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_civic')->nullable();
            $table->string('company_city')->nullable();
            $table->string('company_zip_code')->nullable();
            $table->string('company_vat_number')->nullable();
            $table->string('company_fiscal_code')->nullable();
            // Profilo
            $table->text('profile_image')->nullable();
            $table->longText('bio')->nullable();
            // Social Networks
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('website')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_informations');
    }
};
