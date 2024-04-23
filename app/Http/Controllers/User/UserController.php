<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CreateUserRequest;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Services\User\CreateUserService;
use App\Services\User\DeleteUserService;
use App\Services\User\GetUserService;
use App\Services\User\UpdateUserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function store(CreateUserRequest $request)
    {
        $user = resolve(CreateUserService::class)->setParams($request->validated())->handle();
        if (!$user) {
            return $this->responseErrors('has an error when create user');
        }

        return $this->responseSuccess([
            'user' => $user,
            'message' => 'create user success',
        ]);
    }

    public function delete(int $id, Request $request)
    {
        $user = resolve(DeleteUserService::class)->setParams($request)->handle();
        if (!$user) {
            return $this->responseErrors('Not found user', Response::HTTP_NOT_FOUND);
        }

        return $this->responseSuccess([
            'message' => 'delete user success',
        ]);
    }

    public function index(Request $request)
    {
        $user = resolve(GetUserService::class)->handle();
        if (!$user) {
            return $this->responseErrors('has an error when display user');
        }

        return $this->responseSuccess([
            'users' => $user,
            'message' => 'display users success',
        ]);
    }

    public function update(int $id, UpdateUserRequest $request)
    {
        $data = $request->validated();
        $data['id'] = $id;
        $user = resolve(UpdateUserService::class)->setParams($data)->handle();
        if (!$user) {
            return $this->responseErrors('Not found user', Response::HTTP_NOT_FOUND);
        }

        return $this->responseSuccess([
            'user' => $user,
            'message' => 'update user success',
        ]);
    }
}
