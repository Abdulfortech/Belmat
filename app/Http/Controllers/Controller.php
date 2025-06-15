<?php

namespace App\Http\Controllers;

abstract class Controller
{
    
    public function userResponse($user)
    {
        $data = [
            "id" => $user->id,
            "firstName" => $user->firstName,
            "lastName" => $user->lastName,
            "username" => $user->username,
            "dob" => $user->dob,
            "gender" => $user->gender,
            "email" => $user->email,
            "phone" => $user->phone,
            "state" => $user->state,
            "address" => $user->address,
            "role" => $user->role,
            "isVerified" => $user->isVerified,
            "isPinSet" => is_null($user->pin) ? False : True,
            "address" => $user->address,
        ];
        return $data;
    }


}
