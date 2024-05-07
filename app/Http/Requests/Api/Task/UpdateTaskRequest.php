<?php

namespace App\Http\Requests\Api\Task;

use App\Http\Requests\Api\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'between:6,255',
            ],
            'time_due' => [
                'required',
                'date',
                'after:' . now(),
            ],
            'note' => [
                'nullable',
            ],
            'description' => [
                'nullable',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
