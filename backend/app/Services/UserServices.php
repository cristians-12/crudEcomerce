<?php

namespace App\Services;

use App\Models\User;

class UserServices
{
    public function createUser($data)
    {

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);  // Encriptar contraseña
        $user->save();

        return $user;
    }

    public function getUsers(){
        return User::all();  
    }
}
