<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Implement login
     *
     * @param LoginRequest $request Request form
     * @return json
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            return response()->json(['user' => $user, 'message' => __('messages.login_success')], Response::HTTP_OK);
        }

        return response()->json(['error' => __('messages.unauthorized')], Response::HTTP_UNAUTHORIZED);
    }
}
