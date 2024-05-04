<?php

namespace App\Repositories\Task;

use App\Contracts\Task\TaskRepositoryInterface;
use App\Models\Task;
use App\Repositories\BaseRepository;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    public function __construct(Task $user)
    {
        $this->model = $user;
    }

    public function filter($colum, $value)
    {
        return $this->model->where($colum, $value);
    }

    public function sort($colum, $direction)
    {
        return $this->model->orderBy($colum, $direction);
    }

    public function search($colum, $operator, $value)
    {
        return $this->model->where($colum, $operator, $value);
    }
}
