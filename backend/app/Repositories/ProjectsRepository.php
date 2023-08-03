<?php
namespace App\Repositories;
use App\Http\Resources\ProjectsResource;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\ProjectSkill;
use App\Models\Skill;

class ProjectsRepository {

    public function getAllProjects ()
    {
        return Project::all();
    }

    public function createProject ($data)
    {
        $project = Project::create($data);

        if (isset($data['skills'])) {
            $skills_array = [];

            foreach ($data['skills'] as $skill) {
                array_push($skills_array, [
                    'project_id' => $project->id,
                    'skill_id' => $skill['id']
                ]);
            }

            ProjectSkill::insert($skills_array);
        }

        if (isset($data['members'])) {
            $members_array = [];

            foreach ($data['members'] as $member) {
                array_push($members_array, [
                    'project_id' => $project->id,
                    'user_id' => $member['id']
                ]);
            }

            ProjectMember::insert($members_array);
        }

        return $project->refresh();
    }

    public function orderUsersBy ($sortField, $sortOrder)
    {
        return Project::orderBy($sortField, $sortOrder);
    }

    public function getProjectById(int $id)
    {
        return Project::find($id);
    }

    public function updateProject(Project $project, array $data)
    {
        $update = $project->update($data);

        ProjectSkill::where('project_id', $project->id)->delete();
        ProjectMember::where('project_id', $project->id)->delete();

        if (isset($data['skills'])) {
            $skills_array = [];

            foreach ($data['skills'] as $skill) {
                array_push($skills_array, [
                    'project_id' => $project->id,
                    'skill_id' => $skill['id']
                ]);
            }

            ProjectSkill::insert($skills_array);
        }

        if (isset($data['members'])) {
            $members_array = [];

            foreach ($data['members'] as $member) {
                array_push($members_array, [
                    'project_id' => $project->id,
                    'user_id' => $member['id']
                ]);
            }

            ProjectMember::insert($members_array);
        }

        return $project->refresh();
    }

    public function deleteProject(Project $project)
    {
        return $project->delete();
    }
}
