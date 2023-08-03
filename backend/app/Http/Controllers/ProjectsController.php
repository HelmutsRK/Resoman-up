<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectsResource;
use App\Models\Project;
use App\Repositories\ProjectsRepository;
use App\Repositories\SkillRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectsController extends Controller
{
    private ProjectsRepository $projectsRepository;
    private SkillRepository $skillRepository;

    protected $sortFields = ['customer', 'name', 'start_date', 'end_date', 'created_at', 'updated_at'];

    public function __construct(ProjectsRepository $projectsRepository, SkillRepository $skillRepository)
    {
        $this->middleware('auth:api');
        $this->projectsRepository = $projectsRepository;
        $this->skillRepository = $skillRepository;
    }

    public function all(Request $request): JsonResponse
    {
        $projects = $this->projectsRepository->getAllProjects();
        return $this->success(ProjectsResource::collection($projects));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $input = $this->input([
            'name',
            'number',
            'start_date',
            'end_date',
            'budget',
            'hours',
            'profit_target',
            'customer_id',
            'skills',
            'members'
        ]);

        $validator = $this->validateInput($input, [], new Project());

        if ($validator) {
            return $this->error($validator);
        }

        $input['skills'] = isset($input['skills']) ? $input['skills'] : [];
        $input['members'] = isset($input['members']) ? $input['members'] : [];

        $created_project = $this->projectsRepository->createProject($input);

        return $this->success(new ProjectsResource($created_project));
    }

    /**
     * Display the specified resource.
     */
    public function get(Request $request, int $id)
    {
        $project = $this->projectsRepository->getProjectById($id);

        if ($project) {
            return $this->success(new ProjectsResource($project));
        }

        return $this->error('Not found', 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $project = $this->projectsRepository->getProjectById($id);

        if (!$project) {
            return $this->error('Not found', 404);
        }

        $input = $this->input([
            'name',
            'number',
            'start_date',
            'end_date',
            'budget',
            'hours',
            'profit_target',
            'customer_id',
            'skills',
            'members'
        ]);

        $validator = $this->validateInput($input, [], new Project());

        if ($validator) {
            return $this->error($validator);
        }

        $input['skills'] = isset($input['skills']) ? $input['skills'] : [];
        $input['members'] = isset($input['members']) ? $input['members'] : [];

        $updated_project = $this->projectsRepository->updateProject($project, $input);
        return $this->success(new ProjectsResource($updated_project));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request, int $id)
    {
        $project = $this->projectsRepository->getProjectById($id);

        if (!$project) {
            return $this->error('Not found', 404);
        }

        $delete_project = $this->projectsRepository->deleteProject($project);

        if ($delete_project) {
            return $this->success();
        }

        return $this->error('Something went wrong');
    }
}
