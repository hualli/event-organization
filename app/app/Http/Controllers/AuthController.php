<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\AuthService;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    private AuthService $authService;
    private UserService $userService;

    public function __construct(AuthService $authService, UserService $userService){
        $this->authService = $authService;
        $this->userService = $userService;
    }

    /**
     * User login
     *
     * @param  \App\Http\Requests\LoginRequest  $request  contains email and password
     * @return \Illuminate\Http\JsonResponse  returns the token if the user was authenticated
     */
    public function login(LoginRequest $request)
    {
        if(!$this->authService->authenticateUser($request)){
            return response()->json([
                'message' => 'unauthorized'
            ],401);
        }

        $user = $this->userService->getUser($request->email);

        $token = $this->authService->getToken($user);

        return response()->json([
            'message' => 'authorized',
            'accessToken' => $token,
            'tokenType' => 'Bearer',
            'user' => $user,
        ],200);
    }
}
