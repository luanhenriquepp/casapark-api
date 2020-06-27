<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }

    public function login()
    {
        return $this->userService->login();
    }

    public function register(UserRegisterRequest $request)
    {
        return $this->userService->register($request);
    }
}
