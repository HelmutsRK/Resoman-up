<?php
namespace App\Repositories;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository{

    public function generateJwtByCredentials(array $credentials = []): ?string
    {
        $credentials['allow_login'] = 1;
        $credentials['is_active'] = 1;
        return Auth::attempt($credentials);
    }

    public function generateJwtByModel(User $user): ?string
    {
        return Auth::login($user);
    }

    public function getUser(): Authenticatable|false
    {
        return Auth::user();
    }

    public function logoutUser(): void
    {
        Auth::logout();
    }

    public function refreshJwtToken(): string
    {
        return Auth::refresh();
    }
}
