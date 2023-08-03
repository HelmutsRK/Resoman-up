<?php
namespace App\Repositories;
use App\Http\Resources\ProjectsResource;
use App\Models\Department;
use App\Models\Project;
use App\Models\Skill;

class DepartmentRepository {

    public function getAllDepartments ()
    {
        return Department::all();
    }

    public function getDepartmentById (int $id)
    {
        return Department::find($id);
    }
}
