<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\BaseRequest;

class UpdateUserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => [
                'unique:users,email',
            ],
            'name' => [
                'between:6,255',
            ],
            'password' => [
                'min:8',
                'max:20',
            ],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'email.unique' => 'The email has already been taken.',
        ];
    }
}
