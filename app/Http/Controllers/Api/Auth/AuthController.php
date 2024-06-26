<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Services\Auth\RegisterUserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $result = resolve(RegisterUserService::class)->setParams($request->validated())->handle();
        if (!$result) {
            return $this->responseErrors(__('messages.register_fail'));
        }

        return $this->responseSuccess([
            'user' => $result,
            'message' => __('messages.register_success'),
        ]);
    }

    /**
     * Get a JWT via given credentials.
     * @param  LoginRequest $request
     * @return HttpResponse
     */
    public function login(LoginRequest $request): Response
    {
        $credentials = $request->validated();
        $token = auth()->attempt($credentials);
        if (!$token) {
            return $this->responseErrors(__('messages.unauthorized'), Response::HTTP_UNAUTHORIZED);
        }

        $user = auth()->user();

        return $this->responseSuccess([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
