<?php

namespace App\Services\Auth;

use App\Mail\Auth\VerifyMailRegister;
use App\Services\User\CreateUserService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class RegisterUserService extends CreateUserService
{
    /**
     * Handle the registration process.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $newUser = parent::handle();

            return $newUser;
        } catch (Exception $e) {
            Log::error("register user fail", ['memo' => $e->getMessage()]);

            return false;
        }
    }
}
