<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use App\Services\User\FindUserService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userRole = $request->user()->role;
        $userId = $request->user()->id;
        $user = resolve(FindUserService::class)->setParams($request)->handle();
        if ($user) {
            switch ($userRole) {
                case UserRole::Admin:
                    return $next($request);
                case UserRole::Store:
                    if ($userId === $user->id || $user->role === UserRole::Staff) {
                        return $next($request);
                    }
                    break;
                case UserRole::Staff:
                    if ($userId === $user->id) {
                        return $next($request);
                    }
                    break;
                default:
                    return new Response(__('messages.unauthorized'), Response::HTTP_UNAUTHORIZED);
            }
        }

        return new Response(__('messages.unauthorized'), Response::HTTP_UNAUTHORIZED);
    }
}
