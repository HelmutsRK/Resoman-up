<?php
namespace App\Repositories;
use App\Http\Resources\ProjectsResource;
use App\Models\Department;
use App\Models\EmployeeType;
use App\Models\Position;
use App\Models\Project;
use App\Models\Skill;

class EmployeeTypesRepository {

    public function getAllEmployeeTypes ()
    {
        return EmployeeType::all();
    }

    public function getEmployeeTypeById (int $id)
    {
        return EmployeeType::find($id);
    }
}
