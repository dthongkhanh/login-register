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
            return $this->responseErrors(__('messages.error_action', ['action' => 'create', 'attribute' => 'user',]));
        }

        return $this->responseSuccess([
            'user' => $user,
            'message' => __('messages.create_success', ['attribute' => 'user']),
        ]);
    }

    public function delete(int $id, Request $request)
    {
        $user = resolve(DeleteUserService::class)->setParams($request)->handle();
        if (!$user) {
            return $this->responseErrors(__('messages.error_action', ['action' => 'delete', 'attribute' => 'user',]));
        }

        return $this->responseSuccess([
            'message' => __('messages.delete_success', ['attribute' => 'user']),
        ]);
    }

    public function index(Request $request)
    {
        $user = resolve(GetUserService::class)->handle();
        if (!$user) {
            return $this->responseErrors(__('messages.error_action', ['action' => 'display', 'attribute' => 'users',]));
        }

        return $this->responseSuccess([
            'users' => $user,
            'message' => __('messages.read_success', ['attribute' => 'users']),
        ]);
    }

    public function update(int $id, UpdateUserRequest $request)
    {
        $data = $request->validated();
        $data['id'] = $id;
        $user = resolve(UpdateUserService::class)->setParams($data)->handle();
        if (!$user) {
            return $this->responseErrors(__('messages.error_action', ['action' => 'update', 'attribute' => 'user',]));
        }

        return $this->responseSuccess([
            'user' => $user,
            'message' => __('messages.update_success', ['attribute' => 'user']),
        ]);
    }
}
