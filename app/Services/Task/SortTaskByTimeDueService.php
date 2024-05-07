<?php

namespace App\Services\Task;

use App\Repositories\Task\TaskRepository;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Class SortTaskByTimeDueService.
 */
class SortTaskByTimeDueService extends BaseService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function handle()
    {
        try {
            return $this->taskRepository->sort('time_due', $this->data)->get();
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}
