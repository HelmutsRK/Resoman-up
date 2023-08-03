<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsersResource;
use App\Models\User;
use App\Repositories\UsersRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    private UsersRepository $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->middleware('auth:api');
        $this->usersRepository = $usersRepository;
    }
    public function all(Request $request): JsonResponse
    {
        $users = $this->usersRepository->getAllUsers();
        return $this->success(UsersResource::collection($users));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $input = $this->input([
            'email',
            'password',
            'show_in_list',
            'is_active',
            'allow_login',
            'profile',
            'skills'
        ]);

        $validator = $this->validateInput($input, [], new User());

        if ($validator) {
            return $this->error($validator);
        }

        if ($this->usersRepository->getUserByEmail($input['email'])) {
            return $this->error('User with this email already exists');
        }

        $created_user = $this->usersRepository->createUserWithProfile($input);
        return $this->success(new UsersResource($created_user));
    }

    /**
     * Display the specified resource.
     */
    public function get(Request $request, int $id)
    {
        $user = $this->usersRepository->getUserById($id);

        if ($user) {
            return $this->success(new UsersResource($user));
        }

        return $this->error('Not found', 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $user = $this->usersRepository->getUserById($id);

        if (!$user) {
            return $this->error('Not found', 404);
        }

        $input = $this->input([
            'email',
            'password',
            'show_in_list',
            'is_active',
            'allow_login',
            'profile',
            'skills'
        ]);

        $validator = $this->validateInput($input, [], new User());

        if ($validator) {
            return $this->error($validator);
        }

        $updated_user = $this->usersRepository->updateUser($user, $input);
        return $this->success(new UsersResource($updated_user));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request, int $id)
    {
        $user = $this->usersRepository->getUserById($id);

        if (!$user) {
            return $this->error('Not found', 404);
        }

        $delete_user = $this->usersRepository->deleteUser($user);

        if ($delete_user) {
            return $this->success();
        }

        return $this->error('Something went wrong');
    }
}
