<?php

namespace App\Services\Task;

use App\Contracts\Task\TaskRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Class DeleteTaskService.
 */
class DeleteTaskService extends BaseService
{
    protected $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function handle()
    {
        try {
            return $this->taskRepository->delete($this->data->id);
        } catch (Exception $e) {
            Log::info($e);
            
            return false;
        }
    }
}
