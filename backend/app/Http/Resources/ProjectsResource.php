<?php

namespace App\Http\Resources;


use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectsResource extends JsonResource
{
     /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

     public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer' => $this->customer ? new CustomerResource($this->customer) : null,
            'skills' => $this->skills ? SkillResource::collection($this->skills) : null,
            'members' => $this->members ? UsersResource::collection($this->members) : null,
            'name' => $this->name,
            'number' => $this->number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'budget' => $this->budget,
            'hours' => $this->hours,
            'profit_target' => $this->profit_target,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
