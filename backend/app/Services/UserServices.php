<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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

    public function login($data)
    {
        $credentials = $data->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            session()->regenerate();
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            $cookie = cookie('cookie_token', $token, 60 * 24, null, null, true, false, false, 'None');
            // return response()->json(['message' => 'Login successful'], 200);
            return response(["token" => $token, "user"=> $user], Response::HTTP_OK)->withoutCookie($cookie);
        }

        // Autenticación fallida
        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}
