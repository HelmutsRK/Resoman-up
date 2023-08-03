<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        Skill::query()->insert([
            ['name' => 'Programmēšana', 'type' => 'o'],
            ['name' => 'Vadība', 'type' => 'o'],
            ['name' => 'Projekta vadība', 'type' => 'o'],
            ['name' => 'Finanses', 'type' => 'o'],
            ['name' => 'Finanšu tehnoloģijas', 'type' => 'o'],
            ['name' => 'Cilvēkresursi', 'type' => 'o'],
            ['name' => 'Banku darbība', 'type' => 'o'],
            ['name' => 'Zināšanas par aizdevumiem', 'type' => 'o'],
            ['name' => 'Mārketings', 'type' => 'o'],
            ['name' => 'Pārdošana', 'type' => 'o'],
            ['name' => 'Sabiedriskās attiecības', 'type' => 'o'],
            ['name' => 'Finanšu modelēšana', 'type' => 'o'],

            ['name' => 'PHP', 'type' => 'p'],
            ['name' => 'Java', 'type' => 'p'],
            ['name' => 'Python', 'type' => 'p'],
            ['name' => 'C', 'type' => 'p'],
            ['name' => 'C++', 'type' => 'p'],
            ['name' => 'C#', 'type' => 'p'],
            ['name' => 'Visual Basic', 'type' => 'p'],
            ['name' => 'JavaScript', 'type' => 'p'],
            ['name' => 'Assembly', 'type' => 'p'],
            ['name' => 'SQL', 'type' => 'p'],
            ['name' => 'Swift', 'type' => 'p'],
            ['name' => 'R', 'type' => 'p'],
            ['name' => 'Classic Visual Basic', 'type' => 'p'],
            ['name' => 'Groovy', 'type' => 'p'],
            ['name' => 'Ruby', 'type' => 'p'],
            ['name' => 'Go', 'type' => 'p'],
            ['name' => 'Objective-C', 'type' => 'p'],
            ['name' => 'VBA', 'type' => 'p'],
            ['name' => 'Cobol', 'type' => 'p'],
            ['name' => 'Kotlin', 'type' => 'p'],
            ['name' => 'TypeScript', 'type' => 'p'],
            ['name' => 'Django', 'type' => 'p'],
            ['name' => 'Laravel', 'type' => 'p'],
            ['name' => 'Angular', 'type' => 'p'],
            ['name' => 'HTML/CSS', 'type' => 'p'],
            ['name' => 'Node.JS', 'type' => 'p'],
            ['name' => 'Vue.JS', 'type' => 'p'],
            ['name' => 'Bash/Shell', 'type' => 'p'],
            ['name' => 'Bootstrap', 'type' => 'p'],
            ['name' => 'Next', 'type' => 'p'],
            ['name' => 'Materialize', 'type' => 'p'],
            ['name' => 'Material.io', 'type' => 'p'],
            ['name' => 'React', 'type' => 'p'],
            ['name' => 'Ember', 'type' => 'p']
        ]);
    }
}
