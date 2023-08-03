<?php
namespace App\Repositories;
use App\Http\Resources\UsersResource;
use App\Models\Profile;
use App\Models\User;
use App\Models\UserSkill;

class UsersRepository {
    public function getAllUsers ()
    {
        return User::where(['show_in_list' => 1])->get();
    }

    public function createUserWithProfile ($data)
    {
        $user = User::create($data);

        $profile = Profile::where(['user_id' => $user->id])->first();
        if (!$profile) {
            if (isset($data['profile'])) {
                $data['profile']['user_id'] = $user->id;
                Profile::create($data['profile']);
            }
        }

        $this->setUserSkills($user, $data['skills']);

        return $user->refresh();
    }

    public function getUserByEmail(string $email): ?User
    {
        return User::where(['email' => $email])->first();
    }

    public function updateUser(User $user, array $data)
    {
        $user->profile()->update($data['profile']);
        $this->setUserSkills($user, $data['skills']);
        $user->update($data);
        return $user->refresh();
    }

    public function getUserById(int $id)
    {
        return User::find($id);
    }

    public function deleteUser(User $user)
    {
        return $user->delete();
    }

    private function setUserSkills(User $user, array $skills)
    {
        $user->skills()->delete();

        foreach($skills as $skill) {
            UserSkill::insert([
                'user_id' => $user->id,
                'skill_id' => $skill['skill_id'],
                'rating' => $skill['rating'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
