<?php
namespace App\Repositories;
use App\Http\Resources\SkillResource;
use App\Http\Resources\UserSkillsetResource;
use App\Models\UserSkill;
class UserSkillsetRepository {

    public function getAllUserSkillsets ()
    {
        return UserSkill::all();
    }

    public function createUserSkillset ($data){
        return UserSkill::create($data);
    }


    public function getUserSkillsetById(int $id)
    {
        return UserSkill::find($id);
    }
}
