<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'The email address is not valid.',
            'email.unique' => 'The email address has already been taken.',
            'password.required' => 'Please enter your password.',
            'password.min' => 'The password must be at least :min characters.',
        ];
    }
}
