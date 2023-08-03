<?php
namespace App\Repositories;
use App\Http\Resources\ProjectsResource;
use App\Models\Department;
use App\Models\Position;
use App\Models\Project;
use App\Models\Skill;

class PositionRepository {

    public function getAllPositions ()
    {
        return Position::all();
    }

    public function getPositionById (int $id)
    {
        return Position::find($id);
    }
}
