<?php

namespace App\Console\Commands;

use App\Jobs\SendEmailJob;
use Illuminate\Console\Command;

class SendTaskPastDueNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:task-past-due-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notifications for tasks that are past due';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        dispatch(new SendEmailJob());

        return Command::SUCCESS;
    }
}
