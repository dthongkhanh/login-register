<?php

namespace App\Console\Commands;

use App\Jobs\UpdateTaskStatusJob;
use Illuminate\Console\Command;

class UpdateTaskStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update-task-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status for tasks that are past due';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        dispatch(new UpdateTaskStatusJob());

        return Command::SUCCESS;
    }
}
