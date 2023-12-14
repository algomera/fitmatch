<?php

namespace App\Imports;

use App\Models\Exercise;
use App\Models\ExerciseArea;
use App\Models\ExerciseTypology;
use App\Models\ExerciseZone;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ExerciseImport implements ToCollection, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    /**
     * @param  Collection  $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection->skip(0) as $row) {
            if (!empty($row[0])) {
                $typology = ExerciseTypology::firstOrCreate([
                    'name' => ucfirst(strtolower($row[0]))
                ]);
            }
            if (!empty($row[1])) {
                $zone = ExerciseZone::firstOrCreate([
                    'name' => ucfirst(strtolower($row[1]))
                ]);
            }
            if (!empty($row[2])) {
                $area = ExerciseArea::firstOrCreate([
                    'name' => ucfirst(strtolower($row[2]))
                ]);
            }
            $exercise = Exercise::create([
                'typology_id' => $typology->id,
                'zone_id' => $zone->id,
                'area_id' => $area->id,
                'name' => trim($row[3]),
                'description' => $row[5],
                'link' => trim($row[7])
            ]);
        }
    }
}
