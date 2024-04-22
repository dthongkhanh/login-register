<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\User\CreateUserService;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    /**
     * Implement register
     *
     * @param RegisterRequest $request Request form
     * @return json
     */
    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = bcrypt($validatedData['password']);
        $createUserService = resolve(CreateUserService::class);
        $user = $createUserService->setParams($validatedData)->handle();

        if ($user) {
            return response()->json(['user' => $user, 'message' => __('messages.register_success')], Response::HTTP_OK);
        } else {
            return response()->json(['error' => __('messages.register_fail')], Response::HTTP_UNAUTHORIZED);
        }
    }
}
