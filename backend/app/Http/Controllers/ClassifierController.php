<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\EmployeeTypeResource;
use App\Http\Resources\PositionResource;
use App\Http\Resources\ProjectsResource;
use App\Http\Resources\SkillResource;
use App\Models\Project;
use App\Repositories\CustomersRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\EmployeeTypesRepository;
use App\Repositories\PositionRepository;
use App\Repositories\ProjectsRepository;
use App\Repositories\SkillRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClassifierController extends Controller
{
    private SkillRepository $skillRepository;
    private CustomersRepository $customersRepository;
    private DepartmentRepository $departmentRepository;
    private PositionRepository $positionRepository;
    private EmployeeTypesRepository $employeeTypesRepository;

    public function __construct(
        SkillRepository $skillRepository,
        CustomersRepository $customersRepository,
        EmployeeTypesRepository $employeeTypesRepository,
        PositionRepository $positionRepository,
        DepartmentRepository $departmentRepository
    )
    {
        $this->middleware('auth:api');
        $this->skillRepository = $skillRepository;
        $this->customersRepository = $customersRepository;
        $this->employeeTypesRepository = $employeeTypesRepository;
        $this->positionRepository = $positionRepository;
        $this->departmentRepository = $departmentRepository;
    }
    /**
     * Display the specified resource.
     */
    public function get(Request $request, string $type)
    {
        $data = [];

        switch ($type){
            case "skills":
                $skills = $this->skillRepository->getAllSkills();
                $data = SkillResource::collection($skills);
            break;
            case "customers":
                $customers = $this->customersRepository->getAllCustomers();
                $data = CustomerResource::collection($customers);
                break;
            case "departments":
                $departments = $this->departmentRepository->getAllDepartments();
                $data = DepartmentResource::collection($departments);
                break;
            case "positions":
                $positions = $this->positionRepository->getAllPositions();
                $data = PositionResource::collection($positions);
                break;
            case "employeetypes":
                $employee_types = $this->employeeTypesRepository->getAllEmployeeTypes();
                $data = EmployeeTypeResource::collection($employee_types);
                break;
        }

        return $this->success($data);
    }
}
