<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionsSeeder extends Seeder
{
    public function run(): void
    {
        Position::query()->insert([
            [
                'name_short' => 'Co-F',
                'name_full' => 'Līdzdibinātājs'
            ],
            [
                'name_short' => 'UI/UX',
                'name_full' => 'UI/UX dizainers'
            ],
            [
                'name_short' => 'INT',
                'name_full' => 'Praktikants'
            ],
            [
                'name_short' => 'PROM',
                'name_full' => 'Projektu Vadītājs'
            ],
            [
                'name_short' => 'MID-S',
                'name_full' => 'Vidēja līmeņa programmētājs'
            ],
            [
                'name_short' => 'SEN',
                'name_full' => 'Augsta līmeņā programmētajs'
            ],
            [
                'name_short' => 'JUN',
                'name_full' => 'Zema līmeņa programmētājs'
            ],
            [
                'name_short' => 'QA',
                'name_full' => 'Kvalitātes nodrošināšanas speciālists'
            ],
        ]);
    }
}
