<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\User\CreateUserService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = bcrypt($validatedData['password']);
        $createUserService = resolve(CreateUserService::class);
        $user = $createUserService->setParams($validatedData)->handle();

        if ($user) {
            return response()->json(['user' => $user, 'message' => 'Register success'], 201);
        } else {
            return response()->json(['error' => 'Registration failed'], 500);
        }
    }
}
