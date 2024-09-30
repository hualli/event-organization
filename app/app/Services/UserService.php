<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    /**
     * Get a user by email
     *
     * @param  string  $email  the email address of the user
     * @return \App\Models\User  returns the user model if found
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException  throws an exception if the user is not found
     */
    public function getUser($email){
        return User::where('email',$email)->firstOrFail();
    }
}
