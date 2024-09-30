<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\LoginRequest;

class AuthService{

    /**
     * Authenticates a user
     *
     * @param  \Illuminate\Http\Request  $request  contains email and password
     * @return bool  returns true if authentication is successful, otherwise returns false
     */
    public function authenticateUser(LoginRequest $request){
        if(Auth::attempt($request->only('email','password'))){
            return true;
        }
        return false;
    }

    /**
     * Generates an authentication token
     *
     * @param  \App\Models\User  $user  authenticated user
     * @return string  returns token
     */
    public function getToken(User $user){
        return $user->createToken('auth_token')->plainTextToken;
    }
}
