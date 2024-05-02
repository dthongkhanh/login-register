<?php

namespace App\Services\User;

use App\Interfaces\User\UserRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Class FindIdUserService.
 */
class FindUserService extends BaseService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle()
    {
        try {
            return $this->userRepository->find($this->data->id);
        } catch (Exception $e) {
            Log::info($e);
            
            return false;
        }
    }
}