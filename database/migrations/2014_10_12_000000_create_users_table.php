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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->integer('onboarding_current_step')->default(1);
            $table->enum('status', array_keys(config('fitmatch.profile_statuses')))->nullable()->default('pending');
            //            $table->text('stripe_account_id')->nullable();
            $table->longText('stripe_public')->nullable();
            $table->longText('stripe_secret')->nullable();
            $table->boolean('is_online')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
