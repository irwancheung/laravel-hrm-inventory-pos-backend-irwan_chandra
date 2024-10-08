<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HttpResponseService;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $response;

    public function __construct(HttpResponseService $httpResponseService)
    {
        $this->response = $httpResponseService;
    }

    // login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->response->unauthorized('The provided credentials are incorrect. Please try again.');
        }

        $token = $user->createToken($request->email)->plainTextToken;

        return $this->response->success(
            'Logged in successfully',
            [
                'user' => $user,
                'token' => $token,
            ]
        );
    }

    // logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->response->success('Logged out successfully', null);
    }
}
