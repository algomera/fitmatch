<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anamnesi>
 */
class AnamnesiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'athlete_id' => 3, // ID dell'atleta a cui vuoi associare l'anamnesi
            'work_type' => fake()->word,
            'work_time' => fake()->word,
            'physical_activity' => fake()->randomElement(['very_sedentary', 'sedentary', 'active', 'very_active']),
            'birth_with' => fake()->randomElement(['eutocic', 'cesarean']),
            'stress_level' => fake()->randomElement(['high', 'normal', 'low']),
            'smoke' => fake()->randomElement(['yes', 'no', 'stopped']),
            'smoke_yes_how_many_per_day' => fake()->numberBetween(1, 20),
            'smoke_stopped_since' => fake()->date,
            'alcohol' => fake()->randomElement(['every_day', 'occasionally', 'no', 'teetotal']),
            'coffee' => fake()->boolean,
            'regular_urination' => fake()->boolean,
            'regular_urination_no_why' => fake()->text,
            'regular_defecation' => fake()->boolean,
            'regular_defecation_no_why' => fake()->text,
            'drug_therapies' => fake()->boolean,
            'drug_therapies_yes_which' => fake()->text,
            'drugs_in_past' => fake()->boolean,
            'drugs_in_past_yes_which' => fake()->text,
            'nutritional_supplements' => fake()->boolean,
            'nutritional_supplements_yes_which' => fake()->text,
            'nutritional_supplements_in_past' => fake()->boolean,
            'nutritional_supplements_in_past_yes_which' => fake()->text,
            'traumas' => fake()->boolean,
            'traumas_yes_which' => fake()->text,
            'pacemaker' => fake()->boolean,
            'allergies' => fake()->boolean,
            'allergies_yes_which' => fake()->text,
            'intolerances' => fake()->boolean,
            'intolerances_yes_which' => fake()->text,
            'digestive_difficulties' => fake()->boolean,
            'water_per_day' => fake()->randomElement(['0.5-1lt', '1-2lt', '2-3lt', '3-4lt']),
            'sleep_quality' => fake()->randomElement(['regular', 'disturbed']),
            'bruxism' => fake()->boolean,
            'wake_up_at_night' => fake()->boolean,
            'eating_disorders' => fake()->boolean,
            'diabets' => fake()->boolean,
            'hypertension' => fake()->boolean,
            'dyslipidemia' => fake()->boolean,
            'thyroid_pathology' => fake()->boolean,
            'cardiovascular_diseases' => fake()->boolean,
            'obesity' => fake()->boolean,
            'age_of_menarche' => fake()->numberBetween(10, 16),
            'mestrual_cycle' => fake()->randomElement(['little_abundant', 'very_abundant', 'overdue', 'absent']),
            'pain_of_mestrual_cycle' => fake()->randomElement(['1-2', '2-3', '3-4', '4-5']),
            'menopause' => fake()->randomElement(['physiological', 'latrogena']),
            'contraceptives' => fake()->boolean,
            'contraceptives_yes_why' => fake()->randomElement([
                'birth_control', 'irregularities', 'polycystic_ovary', 'endometriosis'
            ]),
            'contraceptives_yes_which' => fake()->randomElement(['pill', 'ring', 'spiral']),
            'pregnancies' => fake()->boolean,
            'pregnancies_yes_how_many' => fake()->numberBetween(0, 5),
            'pregnancies_type_of_section' => fake()->randomElement(['natual', 'cesarean']),
            'weight' => fake()->numberBetween(40, 120),
            'height' => fake()->numberBetween(150, 200),
            'waist_circumference' => fake()->numberBetween(50, 120),
            'weight_variations_in_short_time' => fake()->boolean,
            'weight_variations_in_short_time_yes_in_kg' => fake()->numberBetween(1, 10),
            'weight_variations_in_short_time_yes_why' => fake()->text,
            'sports_activity_now' => fake()->text,
            'sports_activity_in_past' => fake()->text,
            'years_of_training' => fake()->numberBetween(0, 20),
            'training_per_week' => fake()->numberBetween(0, 7),
            'time_available_for_training' => fake()->numberBetween(1, 24),
            'increase_training_duration' => fake()->boolean,
            'increase_weekly_training_frequencies' => fake()->boolean,
            'articular_pain' => fake()->boolean,
            'articular_pain_yes_which' => fake()->text,
            'know_basic_movements_of_weight_room' => fake()->boolean,
            'know_complementary_movements_of_weight_room' => fake()->boolean,
            'where_consume_daily_meals' => fake()->word,
            'times_for_consume_daily_meals' => fake()->word,
            'easily_prepare_your_meals' => fake()->boolean,
            'hunger_pangs_throughout_the_day' => fake()->boolean,
            'foods_dont_like' => fake()->text,
            'breakfast' => fake()->text,
            'morning_snack' => fake()->text,
            'lunch' => fake()->text,
            'afternoon_snack' => fake()->text,
            'dinner' => fake()->text,
            'pre_nanna' => fake()->text,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
