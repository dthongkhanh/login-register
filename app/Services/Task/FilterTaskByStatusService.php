<?php

namespace App\Services\Task;

use App\Contracts\Task\TaskRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Class FilterTaskByStatusService.
 */
class FilterTaskByStatusService extends BaseService
{

    protected $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function handle()
    {
        try {
            return $this->taskRepository->filter('status', $this->data)->get();
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}
