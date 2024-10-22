<?php

namespace App\Http\Controllers;

use App\Services\UserServices;
use Illuminate\Http\Request;

class UserController
{
    protected $userService;

    public function __construct(UserServices $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {

        return $this->userService->getUsers();
    }

    public function store(Request $request)
    {
        return $this->userService->createUser($request);
    }

    public function login(Request $request)
    {
        return $this->userService->login($request);
    }
}
