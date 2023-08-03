<?php
namespace App\Repositories;
use App\Models\ProjectMember;


class ProjectMembersRepository {

    public function getAllProjectMembers ()
    {
        return ProjectMember::all();
    }

    public function createProjectMember ($data){
        return ProjectMember::create($data);
    }


    public function getProjectMembersById(int $id)
    {
        return ProjectMember::find($id);
    }
}
