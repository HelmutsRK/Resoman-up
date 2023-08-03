<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    public function run(): void
    {
        Department::query()->insert([
            [
                'name_short' => 'MANA',
                'name_full' => 'Vadība'
            ],
            [
                'name_short' => 'DEVE-FE',
                'name_full' => 'Frontend izstrāde'
            ],
            [
                'name_short' => 'DEVE-BE',
                'name_full' => 'Backend izstrāde'
            ],
            [
                'name_short' => 'CONTRA',
                'name_full' => 'Līgumslēdzēji'
            ],
            [
                'name_short' => 'DESIG',
                'name_full' => 'Dizains'
            ],
            [
                'name_short' => 'TEST',
                'name_full' => 'Testēšana'
            ],
            [
                'name_short' => 'PROJE',
                'name_full' => 'Projektu vadība'
            ],
        ]);
    }
}
