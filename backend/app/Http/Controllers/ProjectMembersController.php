<?php

namespace App\Http\Controllers;

use App\Models\ProjectMember;
use App\Repositories\ProjectMembersRepository;
use Illuminate\Http\Request;

class ProjectMembersController extends Controller
{
    private ProjectMembersRepository $projectMembersRepository;

    public function __construct(ProjectMembersRepository $projectMembersRepository)
    {
        $this->middleware('auth:api');
        $this->projectMembersRepository = $projectMembersRepository;
    }

    public function index(Request $request, ProjectMember $projectMembers)
    {

        return $this->projectMembersRepository->getAllProjectMembers();

    }
    public function store(Request $request)
    {
        $requestData = array_merge($request->all());

        return $this->projectMembersRepository->createProjectMember($requestData);
    }

    public function show()
    {

    }

    public function update(Request $request, ProjectMember $projectMembers)
    {


        $projectMembers->project_id = $request->input(key: 'project_id');
        $projectMembers->user_id = $request->input(key: 'user_id');



        $projectMembers->save();

    }

    public function destroy(ProjectMember $projectMembers)
    {
        $projectMembers->delete();
    }
}
