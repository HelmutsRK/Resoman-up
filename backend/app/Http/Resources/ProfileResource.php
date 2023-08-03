<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'first_day_of_work' => $this->first_day_of_work,
            'phone' => $this->phone,
            'cost_rate' => $this->cost_rate,
            'bill_rate' => $this->bill_rate,
            'utilization_target' => $this->utilization_target,
            'department' => $this->department ? new DepartmentResource($this->department) : null,
            'position' => $this->position ? new PositionResource($this->position) : null,
            'employee_type' => $this->employeeType ? new EmployeeTypeResource($this->employeeType) : null
        ];
    }
}
