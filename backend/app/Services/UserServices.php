<?php

namespace App\Services;

use App\Models\User;

class UserServices
{
    public function createUser($data)
    {

        $existingUser = User::where('email', $data['email'])->first();

        if ($existingUser) {
            return response()->json(['error' => 'Email is already in use'], status: 201);
        }

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();

        return response()->json(['message' => 'Success'], 201);
    }

    public function getUsers()
    {
        return User::all();
    }
}
