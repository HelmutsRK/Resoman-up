<?php

namespace App\Http\Resources;


use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
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
            'email' => $this->email,
            'is_active' => $this->is_active,
            'allow_login' => $this->allow_login,
            'profile' => $this->profile ? new ProfileResource($this->profile) : null,
            'skills' => $this->skills ? UserSkillResource::collection($this->skills) : null,
            'name' => $this->profile ? $this->profile->first_name . ' ' . $this->profile->last_name : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
