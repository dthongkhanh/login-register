<?php

namespace App\Contracts\Task;

use App\Interfaces\CrudRepositoryInterface;

interface TaskRepositoryInterface extends CrudRepositoryInterface
{
    public function filter($column, $value);

    public function sort($column, $direction);

    public function search($column, $operator, $value);
}
