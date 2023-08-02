<?php

namespace Database\Seeders;

use App\Imports\ExerciseImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class ExercisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new ExerciseImport, public_path('excel/exercises.xlsx'));

        //        $typologies = [
        //            'Bodybuilding',
        //            'Cardio',
        //            'Defaticamento',
        //            'Functional',
        //            'Nuoto',
        //            'Riscaldamento',
        //            'Stretching'
        //        ];
        //        foreach ($typologies as $typology) {
        //            ExerciseTypology::create([
        //                'name' => $typology
        //            ]);
        //        }
        //
        //        $zones = [
        //            'Addome',
        //            'Braccia',
        //            'Petto',
        //            'Spalle'
        //        ];
        //        foreach ($zones as $zone) {
        //            ExerciseZone::create([
        //                'name' => $zone
        //            ]);
        //        }
        //
        //        $areas = [
        //            'Bicipiti',
        //            'Obliqui',
        //            'Centro'
        //        ];
        //        foreach ($areas as $area) {
        //            ExerciseArea::create([
        //                'name' => $area
        //            ]);
        //        }
        //
        //        $exercise = Exercise::create([
        //            'name' => 'Esercizio A',
        //            'typology_id' => ExerciseTypology::whereName('Bodybuilding')->first()->id,
        //            'zone_id' => ExerciseZone::whereName('Braccia')->first()->id,
        //            'area_id' => ExerciseArea::whereName('Bicipiti')->first()->id,
        //            'description' => "1. Siediti su una panca con la schiena dritta, le braccia sui fianchi, le ginocchia piegate e i piedi sul pavimento. 2. Tieni i manubri tra le mani con i palmi rivolti verso l'interno. 3. Alza uno dei manubri verso la spalla piegando il braccio. 4. Quando arriva vicino alla spalla, torna alla posizione iniziale e ripeti piegando l'altro braccio.Tieni la schiena dritta ed evita di piegarti. 2. Tieni le spalle ferme. 3. Mantieni un ritmo di respirazione regolare ed evita di trattenere il respiro",
        //            'link' => 'https://h7vdtq.db.files.1drv.com/y4mToLP73MmPtGe0wbPFHZmRgWJxvcQTWYdfZ8yRRM2kSE0AZPVF7ZpNdz77D6rsL74uSchPY0Eh3j93AKrqbS2UGcLJVlGSm8Hw_spTcy2fjKa3DF_x9EiOuCh0o5cASunQPEqzjJKk6OnR_9jZsrAwSNrfZogFtHKI6K1FYf-hlqYSPmTMecVihwRu2HLR_BqECRXJ40jG3mFsFpOCTHsxg?'
        //        ]);
    }
}
