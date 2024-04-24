<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\BaseRequest;
use Illuminate\Http\Request;

class UpdateUserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        $userId = $request->route('id');

        return [
            'name' => [
                'required',
                'between:6,255',
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $userId,
            ],
            'password' => [
                'required',
                'min:8',
                'max:20',
                'regex:/^\S+$/',
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
            'name.required' => 'The name field is required.',
            'name.between' => 'The name must be between :min and :max characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least :min characters.',
            'password.max' => 'The password may not be greater than :max characters.',
            'password.regex' => 'The password must not contain white characters.',
        ];
    }
}
