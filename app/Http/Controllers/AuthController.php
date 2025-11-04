<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthLoginRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService,
    ) {}

    public function login(AuthLoginRequest $request)
    {
        $data = $request->validated();

        $token = $this->authService->validateLoginAndGenerateToken($data);

        return $this->respondWithToken($token);
    }

    public function me()
    {
        $user = $this->authService->getCurrentLoggedUser();

        return $this->json($user);
    }

    public function logout()
    {
        $this->authService->logout();

        return $this->success('Logout successfully');
    }

    public function refresh()
    {
        $token = $this->authService->refreshToken();

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return $this->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => $this->authService->getExpiresIn(),
        ], wrapper: false);
    }
}
