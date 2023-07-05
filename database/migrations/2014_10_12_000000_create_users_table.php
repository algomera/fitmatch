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
                $table->boolean('onboarding_step_1')->default(false);
                $table->boolean('onboarding_step_2')->default(false);
                $table->boolean('onboarding_step_3')->default(false);
                $table->boolean('onboarding_step_4')->default(false);
                $table->boolean('onboarding_step_5')->default(false);
                $table->boolean('onboarding_step_6')->default(false);
                $table->boolean('onboarding_step_7')->default(false);
                $table->boolean('onboarding_step_8')->default(false);
                $table->boolean('onboarding_step_9')->default(false);
                $table->boolean('onboarding_step_10')->default(false);
                $table->boolean('onboarding_step_11')->default(false);
//                $table->boolean('onboarding_step_12')->default(false);
                $table->boolean('accepted')->nullable();
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
