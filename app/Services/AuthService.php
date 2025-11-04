<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthService
{
    public function validateLoginAndGenerateToken(array $data): string
    {
        $token = Auth::guard('api')->attempt($data);

        if (!$token) throw new UnauthorizedHttpException('Bearer', 'Invalid credentials');

        return (string) $token;
    }

    public function getCurrentLoggedUser(): array
    {
        /** @var App\Models\User  */
        $user = Auth::user();

        return $user->toArray();
    }

    public function logout(): void
    {
        Auth::logout();
    }

    public function refreshToken(): string
    {
        $token = Auth::refresh();

        return $token;
    }

    public function getExpiresIn(): int
    {
        return Auth::guard('api')->factory()->getTTL() * 60;
    }
}
