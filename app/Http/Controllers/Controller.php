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
            "dob" => $user->dob,
            "gender" => $user->gender,
            "email" => $user->email,
            "phone" => $user->phone,
            "state" => $user->state,
            "lga" => $user->lga,
            "address" => $user->address,
            "role" => $user->role,
            "status" => $user->status,
        ];
        return $data;
    }

    public function lgasResponse($payload)
    {
        $data = $payload->map(function ($lga) {
            return [
                "id" => $lga->id,
                "title" => $lga->title,
                "state" => $lga->state->title ?? null,
                "state_id" => $lga->state_id,
                "status" => $lga->status,
            ];
        });

        return $data;
    }

}
