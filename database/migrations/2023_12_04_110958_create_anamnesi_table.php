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
        Schema::create('anamnesis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class, 'athlete_id')->onDelete('cascade');
            // Lavoro
            $table->string('work_type')->nullable();
            $table->string('work_time')->nullable();
            $table->enum('physical_activity', [
                'very_sedentary',
                'sedentary',
                'active',
                'very_active'
            ])->nullable();
            // Fisiologica
            $table->enum('birth_with', [
                'eutocic',
                'cesarean'
            ])->nullable();
            $table->enum('stress_level', [
                'high',
                'normal',
                'low'
            ])->nullable();
            $table->enum('smoke', [
                'yes',
                'no',
                'stopped'
            ])->nullable();
            $table->string('smoke_yes_how_many_per_day')->nullable();
            $table->string('smoke_stopped_since')->nullable();
            $table->enum('alcohol', [
                'every_day',
                'occasionally',
                'no',
                'teetotal'
            ])->nullable();
            $table->boolean('coffee')->nullable();
            $table->boolean('regular_urination')->nullable();
            $table->text('regular_urination_no_why')->nullable();
            $table->boolean('regular_defecation')->nullable();
            $table->text('regular_defecation_no_why')->nullable();
            $table->boolean('drug_therapies')->nullable();
            $table->text('drug_therapies_yes_which')->nullable();
            $table->boolean('drugs_in_past')->nullable();
            $table->text('drugs_in_past_yes_which')->nullable();
            $table->boolean('nutritional_supplements')->nullable();
            $table->text('nutritional_supplements_yes_which')->nullable();
            $table->boolean('nutritional_supplements_in_past')->nullable();
            $table->text('nutritional_supplements_in_past_yes_which')->nullable();
            $table->boolean('traumas')->nullable();
            $table->text('traumas_yes_which')->nullable();
            $table->boolean('pacemaker')->nullable();
            $table->boolean('allergies')->nullable();
            $table->text('allergies_yes_which')->nullable();
            $table->boolean('intolerances')->nullable();
            $table->text('intolerances_yes_which')->nullable();
            $table->boolean('digestive_difficulties')->nullable();
            $table->enum('water_per_day', [
                '0.5-1lt',
                '1-2lt',
                '2-3lt',
                '3-4lt'
            ])->nullable();
            $table->enum('sleep_quality', [
                'regular',
                'disturbed'
            ])->nullable();
            $table->boolean('bruxism')->nullable();
            $table->boolean('wake_up_at_night')->nullable();
            $table->boolean('eating_disorders')->nullable();
            $table->boolean('diabets')->nullable();
            $table->boolean('hypertension')->nullable();
            $table->boolean('dyslipidemia')->nullable();
            $table->boolean('thyroid_pathology')->nullable();
            $table->boolean('cardiovascular_diseases')->nullable();
            $table->boolean('obesity')->nullable();
            $table->string('age_of_menarche')->nullable();
            $table->enum('mestrual_cycle', [
                'little_abundant',
                'very_abundant',
                'overdue',
                'absent'
            ])->nullable();
            $table->enum('pain_of_mestrual_cycle', [
                '1-2',
                '2-3',
                '3-4',
                '4-5'
            ])->nullable();
            $table->enum('menopause', [
                'physiological',
                'latrogena',
            ])->nullable();
            $table->boolean('contraceptives')->nullable();
            $table->enum('contraceptives_yes_why', [
                'birth_control',
                'irregularities',
                'polycystic_ovary',
                'endometriosis'
            ])->nullable();
            $table->enum('contraceptives_yes_which', [
                'pill',
                'ring',
                'spiral'
            ])->nullable();
            $table->boolean('pregnancies')->nullable();
            $table->string('pregnancies_yes_how_many')->nullable();
            $table->enum('pregnancies_type_of_section', [
                'natual',
                'cesarean',
            ])->nullable();
            // Misure antropometriche
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('waist_circumference')->nullable();
            $table->boolean('weight_variations_in_short_time')->nullable();
            $table->string('weight_variations_in_short_time_yes_in_kg')->nullable();
            $table->text('weight_variations_in_short_time_yes_why')->nullable();
            // Informazioni Generali
            $table->text('sports_activity_now')->nullable();
            $table->text('sports_activity_in_past')->nullable();
            $table->string('years_of_training')->nullable();
            $table->string('training_per_week')->nullable();
            $table->string('time_available_for_training')->nullable();
            $table->boolean('increase_training_duration')->nullable();
            $table->boolean('increase_weekly_training_frequencies')->nullable();
            $table->boolean('articular_pain')->nullable();
            $table->text('articular_pain_yes_which')->nullable();
            $table->boolean('know_basic_movements_of_weight_room')->nullable();
            $table->boolean('know_complementary_movements_of_weight_room')->nullable();
            $table->string('where_consume_daily_meals')->nullable();
            $table->string('times_for_consume_daily_meals')->nullable();
            $table->boolean('easily_prepare_your_meals')->nullable();
            $table->boolean('hunger_pangs_throughout_the_day')->nullable();
            $table->text('foods_dont_like')->nullable();
            $table->text('breakfast')->nullable();
            $table->text('morning_snack')->nullable();
            $table->text('lunch')->nullable();
            $table->text('afternoon_snack')->nullable();
            $table->text('dinner')->nullable();
            $table->text('pre_nanna')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anamnesis');
    }
};
