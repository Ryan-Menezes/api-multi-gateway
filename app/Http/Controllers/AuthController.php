<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        /** @var App\Models\User  */
        $user = Auth::user();

        return $this->json($user->toArray());
    }

    public function logout()
    {
        Auth::logout();

        return $this->success('Logout successfully');
    }

    public function refresh()
    {
        $token = Auth::refresh();

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return $this->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => Auth::guard('api')->factory()->getTTL() * 60
        ], wrapper: false);
    }
}
