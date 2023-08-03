<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\AuthRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->authRepository = $authRepository;
    }

    /**
     * User login that returns user data and generated JWT token
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        $credentials = $this->input(['email', 'password']);
        $validator = $this->validateInput($credentials, [], new User());

        if ($validator) {
            return $this->error($validator);
        }

        $token = $this->authRepository->generateJwtByCredentials($credentials);

        if (!$token) {
            return $this->error('Unauthorized', 401);
        }

        $user = $this->authRepository->getUser();

        return $this->success([
            'user' => $user,
            'token' => $token
        ]);
    }



    public function logout(): JsonResponse
    {
        $this->authRepository->logoutUser();
        return $this->success();
    }

    public function refresh(): JsonResponse
    {
        return $this->success([
            'token' => $this->authRepository->refreshJwtToken()
        ]);
    }


}
