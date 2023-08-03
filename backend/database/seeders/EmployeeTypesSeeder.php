<?php

namespace Database\Seeders;

use App\Models\EmployeeType;
use Illuminate\Database\Seeder;

class EmployeeTypesSeeder extends Seeder
{
    public function run(): void
    {
        EmployeeType::query()->insert([
            ['name' => 'Iekšējais'],
            ['name' => 'Līgumslēdzējs'],
            ['name' => 'Aģentūra']
        ]);
    }
}
