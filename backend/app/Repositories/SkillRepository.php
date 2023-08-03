<?php
namespace App\Repositories;
use App\Http\Resources\ProjectsResource;
use App\Models\Project;
use App\Models\Skill;

class SkillRepository {

    public function getAllSkills ()
    {
        return Skill::all();
    }

    public function getSkillsByIds (array $ids = [])
    {
        return Skill::whereIn('id', $ids)->get();
    }
}
